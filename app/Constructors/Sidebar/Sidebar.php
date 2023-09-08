<?php

namespace App\Constructors\Sidebar;

use Illuminate\Support\Collection;

class Sidebar
{
    private Collection $pages;

    public function __construct()
    {
        $this->pages = collect();
    }

    public function build(): string
    {
        return $this->mergePages();
    }

    public function addPage(SidebarItem $page): static
    {
        $this->pages->push($page);

        return $this;
    }

    private function mergePages(): string
    {
        $this->pages->ensure(SidebarItem::class);

        return $this->pages
            ->filter(fn(SidebarItem $item) => $item->isPermitted())
            ->map(fn(SidebarItem $item) => $item->toHtml())->implode(" ");
    }
}
