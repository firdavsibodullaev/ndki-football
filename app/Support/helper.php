<?php

use Illuminate\Foundation\Vite;

if (!function_exists('vite')) {
    function vite(?string $asset = null)
    {
        if (is_null($asset)) {
            return app(Vite::class);
        }

        return app(Vite::class)->asset($asset);
    }
}
