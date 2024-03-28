<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectorRequest;
use App\Http\Requests\UpdateSectorRequest;
use App\Models\Category\Category;
use App\Models\Category\MasterCategory;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Inertia\Inertia;

class SectorResourceController extends Controller
{
    public function index(Request $request)
    {
        $sectors = Sector::with('category.master_category')->get();
        return Inertia::render("SectorResource/Index", compact('sectors'));
    }
    
    public function create(Request $request)
    {
        $categories = MasterCategory::all();
        return Inertia::render("SectorResource/Create",compact("categories"));
    }

    public function store(StoreSectorRequest $request){
        $name = $request->input("name");
        $code = $request->input("code");
        $description = $request->input("description");
        $category = $request->input("category");
        $current_datetime = Carbon::now();

        $sector= Sector::create([
            'name' => $name,
            'slug' => Str::slug($name,'-'),
            'code' => $code,
            'description' => $description,
            'created_at' => $current_datetime,
            'updated_at' => $current_datetime
        ]);

        $sector->category()->create([
            'master_categori_id' => $category,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect(route("management.sectors"));
    }

    public function edit(Request $request, Sector $sector){
        if($sector->category){}
        $categories = MasterCategory::all();
        return Inertia::render("SectorResource/Edit",compact("categories","sector"));
    }

    public function update(UpdateSectorRequest $request, Sector $sector){
        $name = $request->input("name");
        $code = $request->input("code");
        $description = $request->input("description");
        $category = $request->input("category");
        $current_datetime = Carbon::now();
        $exisitng_sector = Sector::where('code',$code)->first();

        if($sector->category == null){
            $sector->category()->create([
                    'master_category_id' => $category,
                    'created_at' => now(),
                    'updated_at' => now(),
            ]);

        }else{
            $sector->category->update([
                'master_category_id' => $category,
                'updated_at' => now()
            ]);
        }

        $sectorData = [
            'name' => $name,
            'slug' => Str::slug($name,'-'),
            'description' => $description,
            'updated_at' => $current_datetime
        ];

        if($exisitng_sector === null)
            $sectorData['code'] = $code;

        $sector->update($sectorData);
        return redirect(route("management.sectors"));
    }

    public function destroy(Request $request, Sector $sector){
        $sector->category->delete();
        $sector->delete();
    }
}
