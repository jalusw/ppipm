<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Http\Requests\StoreUserCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserResourceController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        return Inertia::render("UserResource/Index", compact('users'));
    }

    public function create(Request $request)
    {
        return Inertia::render("UserResource/Create");
    }

    public function store(StoreUserCreateRequest $request)
    {
        $name = $request->input("name");
        $username = $request->input("username");
        $password = $request->input("password");
        $password_hashed = Hash::make($password);
        $status = $request->input("status");
        $current_datetime = Carbon::now();

        User::create([
            'name' => $name,
            'username' => $username,
            'password' => $password_hashed,
            'is_active' => $status,
            'created_at' => $current_datetime,
            'updated_at' => $current_datetime
        ]);

        return redirect(route('management.users'));
    }

    public function edit(Request $request, User $user)
    {
        return Inertia::render('UserResource/Edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $existing_user = User::where('username', $request->input('username'))->first();

        $name = $request->input("name");
        $username = $request->input("username");
        $password = $request->input("password");
        $password_hashed = Hash::make($password);
        $status = $request->input("status");
        $current_datetime = Carbon::now();

        $user_data = [
            'name' => $name,
            'updated_at' => $current_datetime,
            'is_active' => $status
        ];

        if (!empty($password)){
            $user_data['password'] = $password_hashed;
        }

        if ($existing_user === null)
            $user_data['username'] = $username;

        User::where('id', $user->id)->update($user_data);

        return redirect(route("management.users"));
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();
    }
}
