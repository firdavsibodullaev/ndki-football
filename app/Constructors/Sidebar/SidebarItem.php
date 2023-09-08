<?php

namespace App\Constructors\Sidebar;

use Illuminate\Contracts\Support\Htmlable;

readonly class SidebarItem implements Htmlable
{
    public static function make(
        string  $title,
        ?string $path = null,
        bool    $active = false,
        array   $children = [],
        bool    $permission = true
    ): static
    {
        return new static($title, $path, $active, $children, $permission);
    }

    public function __construct(
        private string  $title,
        private ?string $path = null,
        private bool    $active = false,
        private array   $children = [],
        private bool    $permission = true
    )
    {
    }

    public function toHtml(): string
    {
        if ($this->isHeader()) {
            return $this->headerHtml();
        }

        if ($this->hasChildren()) {
            return $this->wrapWithUl();
        }

        return $this->sidebarItem();
    }

    public function isPermitted(): bool
    {
        return $this->permission;
    }

    private function isHeader(): bool
    {
        return match ($this->path) {
            "#", "javascript:void(0)" => true,
            default => false
        };
    }

    private function headerHtml(): string
    {
        return "<li class=\"nav-header\">$this->title</li>";
    }

    private function hasChildren(): bool
    {
        return !empty($this->children);
    }

    private function wrapWithUl(): string
    {
        $children = "";
        /** @var Htmlable $child */
        foreach ($this->children as $child) {
            $children .= $child->toHtml();
        }

        return "<li class=\"nav-item " . $this->isOpen() . " \">
                    <a href=\"javascript:void(0)\" class=\"nav-link " . $this->isActive() . " \">
                        <i class=\"nav-icon fas fa-tachometer-alt\"></i>
                        <p>
                            $this->title
                            <i class=\"right fas fa-angle-left\"></i>
                        </p>
                    </a>
                    <ul class=\"nav nav-treeview\">$children</ul>
                </li>";
    }

    private function sidebarItem(): string
    {
        return "<li class=\"nav-item\">
                    <a href=\"$this->path\" class=\"nav-link " . $this->isActive() . "\">
                        <i class=\"far fa-circle nav-icon\"></i>
                        <p>$this->title</p>
                    </a>
                </li>";
    }

    private function isOpen(): string
    {
        return $this->active ? 'menu-open' : '';
    }

    private function isActive(): string
    {
        return $this->active ? 'active' : '';
    }
}
