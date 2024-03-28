<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubSectorRequest;
use App\Http\Requests\UpdateSubSectorRequest;
use App\Models\Category\MasterCategory;
use App\Models\SubSector;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Inertia\Inertia;

class SubSectorResourceController extends Controller
{
    //
    public function index()
    {
        $sub_sectors = SubSector::with("sector","category.master_category")->get();
        return Inertia::render("SubSectorResource/Index", compact("sub_sectors"));
    }
    
    public function create(Request $requeset){
        $sectors = Sector::all();
        $categories = MasterCategory::all();
        return Inertia::render("SubSectorResource/Create",compact("sectors","categories"));
    }

    public function store(StoreSubSectorRequest $request){
        $sector_id = $request->input("sector_id");
        $name = $request->input("name");
        $code = $request->input("code");
        $description = $request->input("description");
        $category = $request->input("category");
        $current_datetime = Carbon::now();


        $sub_sector =SubSector::create([
            'sector_id' => $sector_id,
            'name' => $name,
            'slug' => Str::slug($name,'-'),
            'code' => $code,
            'description' => $description,
            'created_at' => $current_datetime,
            'updated_at' => $current_datetime
        ]);

        $sub_sector->category()->create([
            'master_category_id' => $category 
        ]);

        return redirect(route("management.sub-sectors"));
    }

    public function edit(Request $request, SubSector $sub_sector){
        if($sub_sector->category->master_category){}
        $sectors = Sector::all();
        $categories = MasterCategory::all();
        return Inertia::render("SubSectorResource/Edit",compact("sub_sector","sectors","categories"));
    }

    public function update(UpdateSubSectorRequest $request, SubSector $sub_sector){
        $sector_id = $request->input("sector_id");
        $name = $request->input("name");
        $code = $request->input("code");
        $description = $request->input("description");
        $category = $request->input("category");
        $current_datetime = Carbon::now();
        
        $existing_sub_sector = SubSector::where('code',$code)->first();

        if($sub_sector->category == null){
            $sub_sector->category->create([
                'master_category_id' => $category
            ]);
        }else{
            $sub_sector->category->update([
                'master_category_id' => $category
            ]);
        }
        $data = [
            'sector_id' => $sector_id,
            'name' => $name,
            'slug' => Str::slug($name,'-'),
            'description' => $description,
            'updated_at' => $current_datetime,
        ];

        if($existing_sub_sector === null){
            $data['code'] = $code;
        }

        $sub_sector->update($data);

        return redirect(route("management.sub-sectors"));
    }
    
    public function destroy(Request $request, SubSector $sub_sector){
        $sub_sector->category->delete();
        $sub_sector->delete();
    }

}
