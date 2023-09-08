<?php

namespace App\View\Composers;

use App\Constants\RouteActive;
use App\Constructors\Sidebar\Sidebar as SidebarConstructor;
use App\Constructors\Sidebar\SidebarItem;
use Illuminate\View\View;

readonly class Sidebar
{
    public function __construct(
        private SidebarConstructor $sidebar,
        private RouteActive        $routeActive
    )
    {
    }

    public function compose(View $view): View
    {
        $this->addPages();

        return $view->with('sidebar', $this->sidebar->build());
    }

    private function addPages(): void
    {
        $this->addMainPage();
        $this->addListPages();
        $this->addMatchesPages();
        $this->addSettingsPage();
    }

    private function addMainPage(): void
    {
        $this->sidebar->addPage(
            page: SidebarItem::make(
                title: __('Главная страница'),
                path: route('admin.index'),
                active: $this->routeActive->isMainPage()
            )
        );
    }

    private function addListPages(): void
    {
        $this->sidebar->addPage(
            page: SidebarItem::make(
                title: __('Справочник'),
                active: $this->routeActive->isList(),
                children: [
                    SidebarItem::make(
                        title: __('Команды'),
                        path: route('admin.team.index'),
                        active: $this->routeActive->isTeamList(),
                        permission: is_admin()
                    ),
                    SidebarItem::make(
                        title: __('Игроки'),
                        path: route('admin.player.index'),
                        active: $this->routeActive->isPlayerList(),
                        permission: is_admin()
                    ),
                    SidebarItem::make(
                        title: __('Турниры'),
                        path: route('admin.tournament.index'),
                        active: $this->routeActive->isTournamentList(),
                        permission: is_admin()
                    )
                ],
                permission: is_admin()
            )
        );
    }

    private function addMatchesPages(): void
    {
        $this->sidebar->addPage(
            page: SidebarItem::make(
                title: __('Матчи'),
                active: $this->routeActive->isMatchesList(),
                children: [
                    SidebarItem::make(
                        title: __('Сезоны'),
                        path: route('admin.season.index'),
                        active: $this->routeActive->isSeasonList()
                    )
                ]
            )
        );
    }

    private function addSettingsPage(): void
    {
        $this->sidebar->addPage(
            page: SidebarItem::make(
                title: __('Настройки'),
                active: $this->routeActive->isSettingsList(),
                children: [
                    SidebarItem::make(
                        title: __('Пользователи'),
                        path: route('admin.user.index'),
                        active: $this->routeActive->isUsersList(),
                        permission: is_admin()
                    )
                ],
                permission: is_admin()
            )
        );
    }
}
