<?php

namespace App\View\Composers;

use App\Constants\RouteActive;
use App\Constructors\Sidebar\Sidebar as SidebarConstructor;
use App\Constructors\Sidebar\SidebarItem;
use Illuminate\View\View;

class Sidebar
{
    public function __construct(
        private readonly SidebarConstructor $sidebar,
        private readonly RouteActive        $routeActive
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
        $this->addTeamPages();
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

    private function addTeamPages(): void
    {
        $this->sidebar->addPage(
            page: SidebarItem::make(
                title: __('Команды'),
                active: $this->routeActive->isList(),
                children: [
                    SidebarItem::make(
                        title: __('Команды'),
                        path: route('admin.team.index'),
                        active: $this->routeActive->isTeamList()
                    )
                ]
            )
        );
    }
}
