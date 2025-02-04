<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Interfaces\RoleInterface;
use App\Interfaces\TeamInterface;
use App\Models\Position;
use App\Models\Role;
use App\Models\TagUser;
use App\Models\UserImage;
use App\Traits\PermissionHandler;
use App\Traits\UniqueIdGenerator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use App\Interfaces\UserInterface;

class UserController extends BaseController
{
    protected $user;
    protected $role;
    protected $team;

    use UniqueIdGenerator, PermissionHandler;

    public function __construct(
        UserInterface $user,
        RoleInterface $role,
    ) {
        $this->user = $user;
        $this->role = $role;

        $this->setService($this->user);
        $this->setService($this->role);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index()
    {
        $this->authorize('list-user', User::class);

        $lists = $this->user->lists(false, request()->all(), true);
        $roles = setMapping($this->role->lists(), 'id', 'name');

        return Inertia::render(
            'User/User/index',
            [
                'list' => $lists,
                'access' => $this->accessLists(User::class, 'user'),
                'roles' => $roles,
                'agencies' => []
            ]

        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-user', User::class);

        $roles      = setMapping($this->role->lists(), 'id', 'name');

        return Inertia::render('User/User/create', [
            'roles'   => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create-user', User::class);

        try {
            DB::beginTransaction();

            $this->user->storeData(collect($request->all()));

            DB::commit();
            return redirect()->route('user.index');
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
            return redirect()->route('user.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userData   = $this->user->show($id);
        $agencies   = mapAgencies($userData->agency);
        $teams      = mapTeams($userData->team);
        $camps      = mapCamps($userData->camp);
        $blocks     = mapBlocks($userData->block);

        return Inertia::render('User/User/show', [
            'item' => $userData,
            'user_agency' => $agencies,
            'user_team' => $teams,
            'camps' => $camps,
            'blocks' => $blocks,
            'storage_url' => asset('storage/' . $userData->image),
            'access' => $this->accessLists(User::class, 'show-user')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('edit-user', $user);

        $callRoles      = new Role();
        $roles          = $callRoles->getRoles();

        $userData       = $this->user->show($user->id);

        $userData->roles        = $userData->role_id;
        unset($userData->role_id);

        return Inertia::render('User/User/edit', [
            'user'      => $userData,
            'roles'     => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('edit-user', $user);

        try {
            DB::beginTransaction();

            $this->user->updateData(collect($request->all()), $user->id);

            DB::commit();
            return redirect()->route('user.index');
        } catch (Exception $ex) {
            DB::rollback();
            return redirect()->route('user.edit', $user->id);
        }
    }

    public function updateStatus(Request $request, User $user)
    {
        $this->authorize('status-user', $user);

        try {
            DB::beginTransaction();
            $user->update(['active' => $request->active]);

            DB::commit();
            return redirect()->route('user.index');
        } catch (\Exception $exp) {
            DB::rollBack();
            return redirect()->back()->with('message', $exp->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('destroy-user', $user);

        if (!$user) {
            return redirect()->route('user.index');
        }
        $user->delete();
        TagUser::where('user_id', $user->id)->delete();
        DB::table('role_user')->where('user_id', $user->id)->delete();

        return redirect()->route('user.index');
    }

    /**
     * Upload user image
     */
    public function uploadImage(Request $request)
    {
        $user_id = $request->user_id;

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:1024'
        ]);

        if ($request->hasFile('avatar')) {
            $image_path = $request->file('avatar')->store('images', 'public');

            // First check image exist for this user if yes then remove first
            $hasImage = UserImage::where('user_id', $user_id)->first();
            if ($hasImage != null) {
                unlink(storage_path('app/public/' . $hasImage->image));
                UserImage::where('user_id', $user_id)->delete();
            }

            UserImage::create([
                'image' => $image_path,
                'user_id' => $user_id
            ]);
        }

        return redirect()->back();
    }

    /**
     * Show profile
     */
    public function profile()
    {
        $user = auth()->user();
        $user_id = $user->id;
        $userData   = $this->user->show($user_id);
        $agencies   = mapAgencies($userData->agency);
        $teams      = mapTeams($userData->team);
        $camps      = mapCamps($userData->camp);
        $blocks     = mapBlocks($userData->block);

        return Inertia::render('User/User/profile', [
            'item' => $userData,
            'user_agency' => $agencies,
            'user_team' => $teams,
            'camps' => $camps,
            'blocks' => $blocks,
            'storage_url' => asset('storage/' . $userData->image),
            'access' => $this->accessLists(User::class, 'show-user')
        ]);
    }

    /**
     * Change password
     */
    public function changepassword(User $user, UpdatePasswordRequest $request)
    {
        $this->authorize('create-user', User::class);

        try {
            if (Hash::check($request->current_password, auth()->user()->password)) {
                $user->update(['password' => $request->new_password]);
                return redirect()->back();
            } else {
                return redirect()->back()->with('message', 'Current password is not matched!');
            }
        } catch (Exception $ex) {
            return redirect()->back();
        }
    }

    public function authUser(Request $request)
    {
        $userData           = $request->user()->only('id', 'id_no', 'name', 'username', 'email', 'mobile');
        $userData['roles']  = auth()->user()->roles()->first();

        $userData['agencies']  = [];
        $userData['teams']     = [];

        return response([
            'user' => $userData
        ]);
    }

    public function userDetails()
    {
        $checkUser = DB::table('users')
            ->join('role_user', 'role_user.user_id', 'users.id')
            ->select('users.*', 'role_user.role_id')
            ->where('active', 1)
            ->where('users.email', request()->email)
            ->first();
        $agency = [];
        $team = [];

        if ($checkUser) :
            $request = new Request([
                'user_id' => $checkUser->id,
            ]);
            $user = new User();
            $userAgencyTeam = $user->userAgencyTeam($request, true);

            foreach ($userAgencyTeam as $item) :
                array_push($agency, $item['agency_id']);
                if (count($item['team_id'])) :
                    foreach ($item['team_id'] as $data) :
                        array_push($team, $data);
                    endforeach;
                endif;
            endforeach;
        endif;

        return Response([
            'user'      => $checkUser,
            'agency'    => $agency,
            'team'      => $team,
        ]);
    }
}
