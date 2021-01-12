<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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
        // Implicitly grant "Super Admin" role all permissions
		// This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
			if($user->hasRole(['SuperAdmin', 'Desenvolvedor'])) {
				return true;
			}
		});

		Gate::after(function ($user, $ability) {
			return $user->roles->map(function($role) use ($user) {
				return $role->permissions->map(function($permission) use ($user) {
					return $user->hasPermission($permission);
				});
			});
		});
    }
}
