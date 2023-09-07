<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\PasswordRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(
        private readonly UserServiceInterface $userService
    )
    {
    }

    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {
        return view('admin.user.edit', [
            'user' => \auth()->user()
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(UpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $this->userService->updateAndClearCache($user, $request->toDto());

        return to_route('admin.profile.edit');
    }

    public function updatePassword(PasswordRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $this->userService->updatePasswordAndClearCache($user, $request->toDto());

        return to_route('admin.profile.edit')->with('password_message', __('Пароль успешно изменён'));
    }
}
