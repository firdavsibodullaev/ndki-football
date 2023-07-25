<?php

namespace App\Providers;

use App\Contracts\TeamRepositoryInterface;
use App\Contracts\TeamServiceInterface;
use App\Repositories\TeamRepository;
use App\Services\TeamService;
use Illuminate\Support\ServiceProvider;

class BindingProvider extends ServiceProvider
{
    protected array $services = [
        TeamServiceInterface::class => TeamService::class
    ];
    protected array $repositories = [
        TeamRepositoryInterface::class => TeamRepository::class
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        $bindings = $this->services + $this->repositories;
        foreach ($bindings as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
