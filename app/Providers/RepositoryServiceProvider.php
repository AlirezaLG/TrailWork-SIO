<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\TmaRepositoryInterface;
use App\Repositories\Eloquent\TmaRepository;

use App\Repositories\ProjectRepositoryInterface;
use App\Repositories\Eloquent\ProjectRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TmaRepositoryInterface::class, TmaRepository::class);
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
