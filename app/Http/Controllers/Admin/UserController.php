<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\User\UserServiceInterface;
use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\PasswordRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use function auth;

class UserController extends Controller
{
    public function __construct(
        private readonly UserServiceInterface $userService
    )
    {
    }

    public function index(): View
    {
        $users = $this->userService->getAndCache();

        return view('admin.user.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.user.create', ['roles' => Role::cases()]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $this->userService->createAndClearCache($request->toDto());

        return to_route('admin.user.index');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(User $user): View
    {
        return view('admin.user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(UpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $this->userService->updateAndClearCache($user, $request->toDto());

        return to_route('admin.user.index', $user->id);
    }

    public function updatePassword(PasswordRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $this->userService->updatePasswordAndClearCache($user, $request->toDto());

        return to_route('admin.user.index', $user->id)->with('password_message', __('Пароль успешно изменён'));
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->userService->deleteAndClearCache($user);

        return to_route('admin.user.index');
    }
}
