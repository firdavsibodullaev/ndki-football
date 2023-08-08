<?php

namespace App\Providers;

use App\Contracts\MediaLibrary\MediaLibraryRepositoryInterface;
use App\Contracts\MediaLibrary\MediaLibraryServiceInterface;
use App\Contracts\Player\PlayerRepositoryInterface;
use App\Contracts\Player\PlayerServiceInterface;
use App\Contracts\Team\TeamRepositoryInterface;
use App\Contracts\Team\TeamServiceInterface;
use App\Repositories\MediaLibraryRepository;
use App\Repositories\PlayerRepository;
use App\Repositories\TeamRepository;
use App\Services\MediaLibraryService;
use App\Services\PlayerService;
use App\Services\TeamService;
use Illuminate\Support\ServiceProvider;

class BindingProvider extends ServiceProvider
{
    protected array $services = [
        MediaLibraryServiceInterface::class => MediaLibraryService::class,
        PlayerServiceInterface::class => PlayerService::class,
        TeamServiceInterface::class => TeamService::class
    ];
    protected array $repositories = [
        MediaLibraryRepositoryInterface::class => MediaLibraryRepository::class,
        PlayerRepositoryInterface::class => PlayerRepository::class,
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
