<?php

namespace App\Models;

use App\Models\Latrine\Latrine;
use App\Models\Roles\Permission;
use App\Traits\UserNameGenerator;
use App\Traits\ValidateMessage;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use ArnobMonir\PenMan\Traits\PenMan;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, PenMan, ValidateMessage, UserNameGenerator;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_no',
        'name',
        'username',
        'email',
        'mobile',
        'position_id',
        'active',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Interact with the user's address.
     *
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => null,
            set: fn ($value) => app('hash')->make($value),
        );
    }

    protected function username(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => null,
            set: fn ($value) => $this->getUserName($value, $this->email),
        );
    }

    public function avatar()
    {
        return $this->morphOne(User::class, 'media');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasPermission(Permission $permission)
    {
        return $this->hasAnyRoles($permission->roles);
    }

    public function hasAnyRoles($roles)
    {
        if (is_array($roles) || is_object($roles)) {
            return !!$roles->intersect($this->roles)->count();
        }
        return $this->roles->contains('name', $roles);
    }

    public function isAdmin()
    {
        foreach ($this->roles as $role) {
            if (in_array($role->id, [0, 1])) {
                return true;
            }
        }
        return false;
    }

    public function isAgency()
    {
        foreach ($this->roles as $role) {
            if (in_array($role->id, [2])) {
                return true;
            }
        }
        return false;
    }

    public function isSupervisor()
    {
        foreach ($this->roles as $role) {
            if (in_array($role->id, [3])) {
                return true;
            }
        }
        return false;
    }

    public function isVolunteer()
    {
        foreach ($this->roles as $role) {
            if (!in_array($role->id, [0, 1, 2, 3])) {
                return true;
            }
        }
        return false;
    }

    public function tag_agency()
    {
        return $this->hasMany(TagUser::class, 'user_id');
    }

    public function getScopedUsers($request, $ids = null)
    {
        return DB::table('users')
            ->when((!auth()->user()->isAdmin() && !is_null($ids) && count($ids) != 0) || !is_null($request->agency_id), function ($query) use ($ids, $request) {
                $query->join('tag_users as tu', 'tu.user_id', 'users.id')
                    ->where('tu.taggable_type', 'App\\Models\\Agency')
                    ->whereIn('tu.taggable_id', !is_null($request->agency_id) ? [$request->agency_id] : $ids);
            })
            ->join('role_user as ru', 'ru.user_id', 'users.id')
            ->join('roles as r', 'r.id', 'ru.role_id')
            ->select('users.*', 'r.name as role_name')
            ->when(!is_null($request->name), function ($query) use ($request) {
                $query->orderBy($request->name, $request->sort);
            })
            ->when(!is_null($request->search_value), function ($query) use ($request) {
                $query->where('users.email', 'LIKE', '%' . $request->get('search_value') . '%');
                $query->orWhere('users.id_no', 'LIKE', '%' . $request->get('search_value') . '%');
                $query->orWhere('users.mobile', 'LIKE', '%' . $request->get('search_value') . '%');
            })
            ->when(!is_null($request->role_id), function ($query) use ($request) {
                $query->where('r.id', $request->get('role_id'));
            })
            ->groupBy('users.id')
            ->orderBy('users.id', 'Desc')
            ->paginate($request->max_count ?? 10);
        // ->toSql();
    }

    public function userAgencies($only_id = false, $id = null, $listVal = false)
    {
        $query = DB::table('agencies as a')
            ->join('tag_users as tu', function ($join) {
                $join->on('tu.taggable_id', '=', 'a.id')
                    ->where('tu.taggable_type', '=', \App\Models\Agency::class);
            })
            ->when(!auth()->user()->isAdmin() && $id, function ($query) use ($id) {
                $query->whereIn('tu.user_id', gettype($id) == "array" ? $id : [$id]);
            })
            ->when(is_null($id), function ($query) {
                $query->where('tu.user_id', auth()->user()->id);
            })
            ->groupBy('a.id')
            ->select('a.*')
            ->get();

        if ($listVal) :
            return array_map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => $item->agency_name
                ];
            }, $query->toArray());
        endif;

        return $only_id ? $this->mappingIds($query, 'id') : $query;
    }

    public function userAgencyCampBlocks($only_id = false, $id = null)
    {
        return DB::table('agencies as a')
            ->join('camps as c', 'c.id', 'a.camp_id')
            ->join('tag_users as tu', 'tu.taggable_id', 'a.id')
            ->join('blocks as b', 'b.camp_id', 'c.id')
            ->join('tag_areas as ta', 'ta.taggable_id', 'b.id')
            ->where('tu.user_id', is_null($id) ? auth()->user()->id : $id)
            ->where('tu.taggable_type', \App\Models\Agency::class)
            ->where('ta.taggable_type', \App\Models\Encampment\Block::class)
            ->groupBy('a.id')
            ->select('a.id as agency_id', 'a.agency_name as name', 'a.camp_id')
            ->selectRaw('(GROUP_CONCAT(
                DISTINCT CONCAT(c.id,"|",c.name)
                ORDER BY c.id ASC
                SEPARATOR ","
            )) AS camp')
            ->selectRaw('(GROUP_CONCAT(
                DISTINCT CONCAT(b.id,"|",b.name)
                ORDER BY b.id ASC
                SEPARATOR ","
            )) AS block')
            ->get()
            ->map(function ($item) use ($only_id) {
                if ($only_id) :
                    $blocks = !is_null($item->block) ? $item->block = array_map(function ($data) {
                        return (int) data_get(explode('|', $data), 0);
                    }, explode(',', $item->block)) : [];


                    return [
                        'agency_id' => $item->agency_id,
                        'camp' => $item->camp_id,
                        'blocks' => $blocks
                    ];
                else :
                    $indexs = ['id', 'name'];

                    if (!is_null($item->camp)) :
                        $item->camp = array_combine($indexs, explode('|', $item->camp));;
                    endif;

                    $item->blocks = !is_null($item->block) ? array_map(function ($data) use ($indexs) {
                        return array_combine($indexs, explode('|', $data));
                    }, explode(',', $item->block)) : [];

                    unset($item->block);

                    return $item;
                endif;
            });
    }

    public function userTeams($only_id = false)
    {
        $query = DB::table('tag_users as tu')
            ->join('teams as t', 't.id', 'tu.taggable_id')
            ->where('tu.taggable_type', \App\Models\Team::class)
            ->where('tu.user_id', auth()->user()->id)
            ->where('t.active', 1)
            ->when(!$only_id, function ($query) {
                $query->select('t.id as value', 't.team_name as label', 't.agency_id');
            })
            ->get();

        return $only_id ? $this->mappingIds($query) : $query;
    }

    public function userAgencyTeam($request, $only_id = false)
    {
        $results = DB::table('tag_users as tu')
            ->join('users as u', 'u.id', 'tu.user_id')
            ->leftJoin('agencies as a', function ($join) {
                $join->on('tu.taggable_id', 'a.id')
                    ->where('tu.taggable_type', '=', 'App\Models\Agency');
            })
            ->leftJoin('teams as t', function ($join) {
                $join->on('tu.taggable_id', 't.id')
                    ->where('tu.taggable_type', '=', 'App\Models\Team');
            })
            ->when($request->has('user_id'), function ($query) use ($request) {
                $query->where('tu.user_id', $request->user_id);
            })
            ->when(!$request->has('user_id'), function ($query) use ($request) {
                $query->where('tu.user_id', auth()->user()->id);
            })
            ->select('a.id as agency_id', 'a.agency_name', 't.id as team_id', 't.team_name', 't.agency_id as team_agency_id')
            ->orderBy('tu.taggable_type', 'ASC')
            ->get();

        $data = [];

        foreach ($results as $result) :
            if (!is_null($result->agency_id)) :
                $info = [
                    'agency_id' => $result->agency_id,
                    $only_id ? 'team_id' : 'teams' => []
                ];

                if (!$only_id) $info['agency_name'] = $result->agency_name;
                ksort($info);

                array_push($data, $info);
            endif;

            if (!is_null($result->team_id)) :
                $key = array_search($result->team_agency_id, array_column($data, 'agency_id'));
                $info = [
                    'team_id' => $result->team_id,
                    'team_name' => $result->team_name
                ];

                array_push($data[$key][$only_id ? 'team_id' : 'teams'], !$only_id ? $info : $result->team_id);
            endif;
        endforeach;

        return $data;
    }

    private function mappingIds($data, $column = 'taggable_id')
    {
        return $data->map(function ($item) use ($column) {
            return data_get($item, $column);
        });
    }

    public function position()
    {
        return $this->hasOne(Position::class, 'id');
    }


    public function getUserlatrineId()
    {
        $user = auth()->user();
        $isAgency = $user->isAgency();

        $request = new Request([
            'user_id' => $user->id,
        ]);

        if ($isAgency) :
            $agency = new Agency();
            $agencies = $agency->agencyCampBlock($request, true);
        endif;

        if (!$isAgency) :
            $team = new Team();
            $agencies = $team->teamCampBlock($request, true);
        endif;

        $camps = [];
        $blocks = [];
        foreach ($agencies as $agency) :
            if ($agency['camp_id']) :
                array_push($camps, $agency['camp_id']);
            endif;
            if (count($agency['block_id']) != 0) :
                foreach ($agency['block_id'] as $block) :
                    array_push($blocks, $block);
                endforeach;
            endif;
        endforeach;
        $camps = array_values(array_unique($camps));
        $blocks = array_values(array_unique($blocks));

        request()->merge([
            'blocks'    => $blocks,
            'camps'     => $camps,
        ]);
        $latrine = new Latrine();
        $lists = $latrine->getScopedLatrines(request(), false);
        $latrine_ids = $lists->map(function ($item) {
            return $item->id;
        });
        return $latrine_ids;
    }
}
