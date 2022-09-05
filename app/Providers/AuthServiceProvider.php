<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (!$this->app->routesAreCached()) {
            Passport::routes();
        }

        try {
            if (Schema::hasTable('permissions')) :
                $permissions = \App\Models\Roles\Permission::with('roles')->get();
                foreach ($permissions as $permission) {
                    Gate::define($permission->name, function (\App\Models\User $user) use ($permission) {
                        if ($user->isAdmin()) { //ADMIN PERMISSIONS
                            return true;
                        }
                        return $user->hasPermission($permission);
                    });
                }
            endif;
        } catch (\Exception $e) {
            abort(403);
        }
    }
}
