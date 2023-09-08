<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    protected array $roles = [
        'admin' => [Role::ADMIN],
        'admin_moderator' => [Role::ADMIN, Role::MODERATOR],
        'moderator' => [Role::MODERATOR]
    ];

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, string $key = 'moderator'): Response
    {
        if (!in_array($request->user()->role, $this->roles[$key])) {
            abort(403);
        }
        return $next($request);
    }
}
