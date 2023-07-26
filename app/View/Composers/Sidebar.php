<?php

namespace App\View\Composers;

use App\Constructors\Sidebar\Sidebar as SidebarConstructor;
use App\Constructors\Sidebar\SidebarItem;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class Sidebar
{
    public function __construct(
        private readonly SidebarConstructor $sidebar
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
        $mainPage = SidebarItem::make(
            __('Главная страница'),
            route('admin.index'),
            $this->isActive('admin.index')
        );

        $this->sidebar->addPage($mainPage);
    }

    private function isActive(string $name): bool
    {
        return $this->isCurrentRoute($name);
    }

    private function isCurrentRoute(string $name): bool
    {
        return Route::currentRouteName() === $name;
    }
}
