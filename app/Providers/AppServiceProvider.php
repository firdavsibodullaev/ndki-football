<?php

namespace App\Providers;

use App\View\Composers\Sidebar;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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

        Validator::extend(
            rule: 'array_length',
            extension: function (string $attribute, array $value, array $parameters) {

                if (count($parameters) === 0) {
                    return false;
                }

                $rule = $parameters[0];

                if ($rule === 'even') {
                    return count($value) % 2 === 0;
                }

                if ($rule === 'odd') {
                    return count($value) % 2 !== 0;
                }

                if ($rule == 0) {
                    return false;
                }

                if (is_numeric($rule)) {
                    return count($value) % $rule === 0;
                }

                return false;
            });

        Validator::replacer(
            rule: 'array_length',
            replacer: fn(string $entity, string $attribute, string $rule, array $parameters) => Str::of("The :attribute must have :parameter number values")
                ->replace(":attribute", $attribute)
                ->replace(":parameter", $parameters[0] ?? '0')
        );
    }
}
