<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repo\testRepositoryinterface;
use App\Repo\testRepository;
class RepoProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // $this->app->bind(
        //     testRepositoryinterface::class , testRepository::class );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
