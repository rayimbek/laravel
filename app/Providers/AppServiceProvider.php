<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Grade;
use App\Policies\GradePolicy;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    protected $policies = [
        Grade::class => GradePolicy::class,
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
