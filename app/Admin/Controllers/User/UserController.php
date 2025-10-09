<?php

namespace App\Admin\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService,
        protected RoleService $roleService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $filters = [];
        if ($request->get('search')) {
            $filters['search'] = $request->input('search');
        }

        $users = $this->userService->listUsers($filters);
        $roles = $this->roleService->options();

        return view('admin.user.index', compact(
            'users',
            'roles',
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->userService->create($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();
        $this->userService->edit($user, $validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
