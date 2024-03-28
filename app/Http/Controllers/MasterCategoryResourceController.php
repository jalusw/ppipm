<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMasterCategoryRequest;
use App\Http\Requests\UpdateMasterCategoryRequest;
use App\Models\Category\MasterCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Inertia\Inertia;

class MasterCategoryResourceController extends Controller
{
    public function index()
    {
        $master_categories = MasterCategory::all();
        return Inertia::render("MasterCategoryResource/Index", compact("master_categories"));
    }

    public function create(Request $request)
    {
        return Inertia::render("MasterCategoryResource/Create");
    }

    public function store(StoreMasterCategoryRequest $request)
    {
        $name = $request->input("name");
        $current_datetime = Carbon::now();

        MasterCategory::create([
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'created_at' => $current_datetime,
            'updated_at' => $current_datetime
        ]);

        return redirect(route("management.master-categories"));
    }

    public function edit(Request $request, MasterCategory $master_category)
    {
        return Inertia::render("MasterCategoryResource/Edit", compact("master_category"));
    }

    public function update(UpdateMasterCategoryRequest $request, MasterCategory $master_category)
    {
        $name = $request->input("name");
        $current_datetime = Carbon::now();

        $master_category->update([
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'updated_at' => $current_datetime,
        ]);

        return redirect(route("management.master-categories"));
    }

    public function destroy(Request $request, MasterCategory $master_category)
    {
        $master_category->delete();
        // Tambahkan logika redirect setelah menghapus
    }
}
