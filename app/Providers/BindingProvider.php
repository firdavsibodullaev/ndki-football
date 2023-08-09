<?php

namespace App\Providers;

use App\Contracts\Game\GameRepositoryInterface;
use App\Contracts\Game\GameServiceInterface;
use App\Contracts\MediaLibrary\MediaLibraryRepositoryInterface;
use App\Contracts\MediaLibrary\MediaLibraryServiceInterface;
use App\Contracts\Player\PlayerRepositoryInterface;
use App\Contracts\Player\PlayerServiceInterface;
use App\Contracts\Season\SeasonRepositoryInterface;
use App\Contracts\Season\SeasonServiceInterface;
use App\Contracts\SeasonTeam\SeasonTeamRepositoryInterface;
use App\Contracts\SeasonTeam\SeasonTeamServiceInterface;
use App\Contracts\Team\TeamRepositoryInterface;
use App\Contracts\Team\TeamServiceInterface;
use App\Repositories\GameRepository;
use App\Repositories\MediaLibraryRepository;
use App\Repositories\PlayerRepository;
use App\Repositories\SeasonRepository;
use App\Repositories\SeasonTeamRepository;
use App\Repositories\TeamRepository;
use App\Services\GameService;
use App\Services\MediaLibraryService;
use App\Services\PlayerService;
use App\Services\SeasonService;
use App\Services\SeasonTeamService;
use App\Services\TeamService;
use Illuminate\Support\ServiceProvider;

class BindingProvider extends ServiceProvider
{
    protected array $services = [
        GameServiceInterface::class => GameService::class,
        MediaLibraryServiceInterface::class => MediaLibraryService::class,
        PlayerServiceInterface::class => PlayerService::class,
        SeasonServiceInterface::class => SeasonService::class,
        SeasonTeamServiceInterface::class => SeasonTeamService::class,
        TeamServiceInterface::class => TeamService::class
    ];
    protected array $repositories = [
        GameRepositoryInterface::class => GameRepository::class,
        MediaLibraryRepositoryInterface::class => MediaLibraryRepository::class,
        PlayerRepositoryInterface::class => PlayerRepository::class,
        SeasonRepositoryInterface::class => SeasonRepository::class,
        SeasonTeamRepositoryInterface::class => SeasonTeamRepository::class,
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
