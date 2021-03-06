<?php

namespace App\Providers;

use App\Models\Applications;
use App\Models\Internships;
use \App\Policies\InternshipPolicy as InternshipPolicy;
use \App\Policies\ApplicationsPolicy as ApplicationsPolicy;
use \App\Policies\CompaniesPolicy as CompaniesPolicy;
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
         'App\Models\Model' => 'App\Policies\ModelPolicy',
         \App\Models\Internships::class =>  InternshipPolicy::class,
         \App\Models\Companies::class => CompaniesPolicy::class,
         \App\Models\Applications::class => Applications::class
        //\App\Models\User::class => \App\Policies\UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
