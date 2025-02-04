<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use App\Traits\UniqueIdGenerator;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository implements UserInterface
{
    use UniqueIdGenerator;
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // Query Data
    public function query()
    {
        return $this->user
            ->join('role_user', 'role_user.user_id', 'users.id')
            ->join('roles', 'roles.id', 'role_user.role_id')
            ->leftJoin('user_images', 'user_images.user_id', '=', 'users.id')
            ->select(
                'users.id',
                'users.id_no',
                'users.name',
                'users.username',
                'users.email',
                'users.mobile',
                'users.active',
                'roles.name as role_name',
                'roles.id as role_id',
                'users.created_at as joined',
                'user_images.image'
            )
            ->groupBy('users.id');
    }

    // Fetching List Data
    public function lists($paginate = false, $params = null, $sort = false)
    {
        $query = $this->query();
        //For Sort
        if ($sort && data_get($params, 'name')) :
            $query = $this->sortResult($query, data_get($params, 'name'), data_get($params, 'sort'));
        endif;

        return $paginate ? $this->resultWithPagination($query, data_get($params, 'max_count') ?? 10) : $this->resultSet($query);
    }

    public function total($params = null)
    {
        $query = $this->query();
        return $query->get()->count();
    }

    // Fetching Specific Single Row
    public function show($id)
    {
        $query = $this->query();

        return $query->findOrFail($id);
    }

    // Storing Data
    public function storeData($data)
    {
        $userData = $data->only('name', 'email', 'username', 'mobile', 'password');
        $userData['id_no']  = $this->getUserId($data['roles']);
        $userinfo = $this->store($userData->toArray());

        // ADD ROLES
        $this->roleDataHandler($userinfo, $data['roles'], data_get($data, 'role_id'));
        return $userinfo;
    }

    // Updating Data
    public function updateData($data, $id)
    {
        $userData   = $data->only('name', 'email', 'mobile', 'password');
        $userinfo   = $this->update($userData->toArray(), $id);

        // UPDATE ROLES
        $this->roleDataHandler($userinfo, $data['roles'], data_get($data, 'role_id'));
        return $userinfo;
    }

    // Handel User Role Data
    private function roleDataHandler($reference, $data, $roleId = null)
    {
        if (!empty($roleId) && $roleId > $data[0]) :
            $reference->roles()->detach();
            $reference->roles()->attach($data);
        elseif (empty($roleId)) :
            $reference->roles()->detach();
            $reference->roles()->attach($data);
        endif;
    }

    // Handel Tag User
    private function tagUserDataHandler($requestData, $userinfo)
    {
        $users = [];
        foreach ($requestData as $item) :
            if (!is_null($item['agency_id'])) :
                array_push($users, [
                    'taggable_type' => \App\Models\Agency::class,
                    'taggable_id'  => $item['agency_id'],
                    'user_id'      => $userinfo->id
                ]);
            endif;
            foreach ($item['team_id'] as $getTeam) :
                if (!is_null($getTeam)) :
                    array_push($users, [
                        'taggable_type' => \App\Models\Team::class,
                        'taggable_id'  => $getTeam,
                        'user_id'      => $userinfo->id
                    ]);
                endif;
            endforeach;
        endforeach;

        $this->tagUser->store($users);
    }

    // Store Data
    public function store($data, $batch = false)
    {
        if ($batch) :
            return $this->user->Insert($data);
        else :
            return $this->user->create($data);
        endif;
    }

    // Update Data
    public function update($data, $id)
    {
        $user = $this->user->findOrFail($id);
        $user->update($data);
        return $user;
    }
}
