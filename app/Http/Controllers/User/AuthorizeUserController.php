<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PermissionUser;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class AuthorizeUserController extends Controller
{
    //
    public function index(Request $request, User $user)
    {
        $permissions = Permission::all();
        $user_permissions = $user->permissions;
        return Inertia::render("Authorize/Index", compact("permissions", "user", "user_permissions"));
    }

    public function store(Request $request, User $user)
    {
        $selected_permissions = json_decode($request->getContent());
        $user_id = $user->id;
        $current_datetime = Carbon::now();
        PermissionUser::where('user_id', $user->id)->delete();
        foreach ($selected_permissions as $permission) {
            if ($permission->selected == false)
                continue;
            PermissionUser::create([
                'user_id' => $user_id,
                'permission_id' => $permission->id,
                'created_at' => $current_datetime,
                'updated_at' => $current_datetime
            ]);
        }
    }
}
