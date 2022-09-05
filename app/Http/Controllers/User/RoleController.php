<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Traits\PermissionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class RoleController extends Controller
{
    use PermissionHandler;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list-role', Role::class);
        $lists = DB::table('roles')
            ->when(1 < auth()->user()->roles[0]->id, function ($query) {
                $query->where('id', '>', auth()->user()->roles[0]->id);
            })
            ->when(request()->has('name'), function ($query) {
                $query->orderBy(request()->name, request()->sort);
            })
            ->paginate(request()->max_count ?? 10);

        return Inertia::render('User/Role/Index', [
            'lists' => $lists,
            'access' => $this->accessLists(Role::class, 'role')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-role', Role::class);

        // $roles = auth()->user()->roles()->get()->map(function($item){
        //     return $item->id;
        // })->toArray();

        // dump($roles);

        $permissions = $this->getPermissionLists();

        return Inertia::render('User/Role/Create', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $this->authorize('create-role', Role::class);

        try {
            DB::beginTransaction();
            $role = ROle::create($request->except('assign'));
            $permissions = $this->getPermissionArray($request->assign, $role->id);
            $role->permissions()->attach($permissions);
            DB::commit();

            return redirect()->route('role.index');
        } catch (\Exception $error) {
            DB::rollBack();
            dd($error->getMessage());
            return back()->withErrors($error->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('edit-role', $role);

        $role->assign = $this->getPermissionLists($role->id);

        return Inertia::render('User/Role/Update', [
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('edit-role', $role);

        $role->update($request->except('assign'));

        $permissions = $this->getPermissionArray($request->assign, $role->id);
        if(count($permissions) > 0):
            $role->permissions()->detach();
            $role->permissions()->attach($permissions);
        endif;

        return redirect()->route('role.index');
    }

    public function updateStatus(Request $request, Role $role)
    {
        $this->authorize('status-role', $role);

        try {
            DB::beginTransaction();
            $role->update(['active' => $request->active]);

            DB::commit();
            return redirect()->route('role.index');
        } catch (\Exception $exp) {
            DB::rollBack();
            return redirect()->back()->with('message', $exp->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('destroy-role', $role);
    }
}
