<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Carbon\Carbon;
use App\Models\Project;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        $this->registerPolicies();
        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addHours(24));
        Passport::refreshTokensExpireIn(Carbon::now()->addHours(24));

    }
}
