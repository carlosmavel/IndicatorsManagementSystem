<?php

namespace Indicators\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Indicators\Department;
use Indicators\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'Indicators\Model' => 'Indicators\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $departments = Department::with('roles')->get();
        
        foreach ($departments as $dept){
            $gate->define($dept->name, function(User $user) use ($dept){
                return $user->hasDepartment($dept);                
            });
        }
    }
}
