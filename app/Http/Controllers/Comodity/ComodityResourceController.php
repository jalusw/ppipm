<?php

namespace App\Http\Controllers\Comodity;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComodityRequest;
use App\Http\Requests\UpdateComodityRequest;
use App\Models\Category\Category;
use App\Models\Category\MasterCategory;
use App\Models\Comodity;
use App\Models\JsonData;
use App\Models\Sector;
use App\Models\SubSector;
use App\Models\TabularData;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ComodityResourceController extends Controller
{
    public function index(Request $request){
        $comodities = Comodity::where("archived",0)->with("sub_sector","category.master_category")->get();
        return Inertia::render("ComodityResource/Index",compact('comodities'));
    }

    public function create(Request $request)
    {
        $sectors = Sector::with('sub_sectors')->get();
        $categories = MasterCategory::all();
        return Inertia::render("ComodityResource/Create", compact("sectors","categories"));
    }

    public function store(StoreComodityRequest $request)
    {
        $name = $request->input('name');
        $sub_sector_id = $request->input('sub_sector_id');
        $description = $request->input('description');
        $current_datetime = Carbon::now();
        $category = $request->input('category');

        $image_filename = "";
        
        if($request->file('image'))
        {
            $image_upload = $request->file('image');
            $image_filename = Str::uuid() . "." . $image_upload->extension();
            $image_upload->storeAs('images/comodities',$image_filename);
        }

        $comodity = Comodity::create([
            'sub_sector_id' => $sub_sector_id,
            'name' => $name,
            'slug' => Str::slug($name,'-'),
            'image' => $image_filename,
            'description' => $description,
            'created_at' => $current_datetime,
            'updated_at' => $current_datetime
        ]);

        $comodity->category()->create([
            'master_category_id' => $category,
            'created_at' => $current_datetime,
            'updated_at' => $current_datetime
        ]);

        return redirect(route("management.comodities"));
    }

    public function edit(Request $request, Comodity $comodity)
    {
        $sectors = Sector::with('sub_sectors')->get();
        $comodity = Comodity::with('sub_sector.sector','category')->where('id',$comodity->id)->first();
        $sub_sectors = SubSector::where('sector_id',$comodity->sub_sector->sector->id)->get();
        $categories = MasterCategory::all();
        return Inertia::render("ComodityResource/Edit",compact("comodity",'sectors','sub_sectors','categories'));
    }

    public function update(UpdateComodityRequest $request, Comodity $comodity)
    {
        $name = $request->input('name');
        $sub_sector_id = $request->input('sub_sector_id');
        $description = $request->input('description');
        $current_datetime = Carbon::now();
        $category = $request->input('category');

        $existing_comodity = Comodity::where('name',$request->input("name"))->first();

        if($comodity->category === null){
            $comodity->category()->create([
                'master_category_id' => $category,
                'created_at' => $current_datetime,
                'updated_at' => $current_datetime
            ]);
        }
        
        if($comodity->category)
        {
            $comodity->category()->first()->update([
                'master_category_id' => $category,
                'created_at' => $current_datetime,
                'updated_at' => $current_datetime
            ]);

        }

        
        $data = [
            'sub_sector_id' => $sub_sector_id,
            'name' => $name,
            'description' => $description,
            'created_at' => $current_datetime,
            'updated_at' => $current_datetime
        ];


        if(isset($request->image))
        {
            $image_filename = $comodity->image;
            Storage::delete("images/comodities/$image_filename");

            $image_upload = $request->file('image');
            $image_upload->storeAs('images/comodities',$image_filename);
        }

        if($existing_comodity)
        {
            $data['name'] = $name;
            $data['slug'] = Str::slug($name,'-');
        }

        $comodity->update($data);
        
        return redirect(route("management.comodities"));
    }

    public function destroy(Request $request, Comodity $comodity)
    {
        $image_filename = $comodity->image;
        Storage::delete("images/comodities/$image_filename");

        TabularData::where("tabular_dataable_id",$comodity->id)->where("tabular_dataable_type","App\Models\Comodity")->get()->map(function($data){
            JsonData::where("dataable_id",$data->id)->where("dataable_type","App\Models\TabularData")->first()->delete();
            $data->delete();
        });

        if($comodity->article_content){
            $comodity->article_content->first()->delete();
        }

        if($comodity->geo_json && $comodity->geo_json->first()->json_data){
            $comodity->geo_json->first()->json_data->first()->delete();
        }

        if($comodity->geo_json){
            $comodity->geo_json->first()->delete();
        }

        $comodity->category()->delete();
        $comodity->delete();
    }

}
