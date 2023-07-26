<?php

namespace App\Providers;

use App\View\Composers\Sidebar;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach (glob(__DIR__ . '/../Support/*.php') as $helper) {
            require_once $helper;
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('admin.layouts.aside', Sidebar::class);
    }
}
