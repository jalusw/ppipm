<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class PermissionResourceController extends Controller
{
    public function index(Request $request)
    {
        $permissions = Permission::all();
        return Inertia::render("PermissionResource/Index", compact('permissions'));
    }

    public function create(Request $request)
    {
        return Inertia::render("PermissionResource/Create");
    }

    public function store(StorePermissionRequest $request)
    {
        $name = $request->input("name");
        $access_code = $request->input("access_code");
        $description = $request->input("description");
        $current_datetime = Carbon::now();

        Permission::create([
            "name" => $name,
            "access_code" => $access_code,
            "description" => $description,
            "created_at" => $current_datetime,
            "updated_at" => $current_datetime,
        ]);

        return redirect(route("mangement.permissions"));
    }

    public function edit(Request $request, Permission $permission)
    {
        return Inertia::render("PermissionResource/Edit", compact("permission"));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $name = $request->input("name");
        $access_code = $request->input("access_code");
        $description = $request->input("description");
        $current_datetime = Carbon::now();

        $permission_data = ([
            "name" => $name,
            "description" => $description,
            "updated_at" => $current_datetime,
        ]);

        $existing = Permission::where("access_code", $access_code)->first();

        if ($existing === null)
            $permission_data["access_code"] = $access_code;

        $permission->update($permission_data);

        return redirect(route("management.permissions"));
    }

    public function destroy(Request $request, Permission $permission)
    {
        $permission->delete();
    }
}
