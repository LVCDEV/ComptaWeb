<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserFilterRequest;
use App\Models\Admin\User;
use App\Models\Admin\UserType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('admin.user.index', [
            'users' => User::with('userType')->paginate(25),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $user = new User();
        return view('admin.user.form', [
            'user' => $user,
            'usertypes' => UserType::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserFilterRequest $request) : RedirectResponse | View
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->validated('password'));
        $user = User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'the new user has been saved');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user) : View
    {
        return view('admin.user.form', [
            'user' => $user,
            'usertypes' => UserType::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, UserFilterRequest $request) : RedirectResponse | View
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->validated('password'));
        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'The user has been modified');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) : RedirectResponse | View
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'The user has been deleted');
    }
}
