<?php

namespace App\Http\Controllers;

use App\Interfaces\UserInterface;
use App\Models\User;
use App\Traits\PermissionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Enum\ColorCode;
use App\Interfaces\DashboardInterface;
use Carbon\Carbon;

class DashboardController extends BaseController
{
    use PermissionHandler;

    public function __construct(
        protected UserInterface $user,
        protected DashboardInterface $dashboard
    ) {
        $this->setService($this->user);
        $this->setService($this->dashboard);
    }

    public function index()
    {

        // $result    = $this->user->show(Auth::id());
        // $users      = $this->user->total();

        return Inertia::render(
            'Dashboard/Index',
            [
                'camps' => [],
                'blocks' => [],
                'sanitationZones' => 10,
                'agencies' => [],
                'sanitation-zones' => [],
                'teams' => [],
                'total-agencies' => [],
                'total-blocks' => 10,
                'total-camps' => 20,
                'total-teams' => 21,
                'total-users' => 20,
                'total-latrines' => 100,
                'total-sanitation-zones' => 120,
                'months' => [],
                'years' => [],
            ]
        );
    }

    public function show(User $user)
    {
        dd($user->toArray());
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return to_route('datatable.demo');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return to_route('datatable.demo');
    }

    public function getMenus(Request $request)
    {
        $roles = auth()->user()->roles()->get()->map(function ($item) {
            return $item->id;
        })->toArray();

        return $this->getPermissionLists($roles);
    }
}
