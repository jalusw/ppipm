<?php

namespace App\Http\Controllers\Comodity;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComodityTabularData;
use App\Http\Requests\StoreComodityTabularDataRequest;
use App\Http\Requests\StoreOrUpdateComodityTabularData;
use App\Models\Comodity;
use App\Models\JsonData;
use App\Models\TabularData;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ComodityDataTabularController extends Controller
{
    public function create(Request $request, $comodity)
    {
        $comodity = Comodity::with("tabular_data")->findOrFail($comodity)->first();
        return Inertia::render("ComodityData/Tabular/Create",compact("comodity"));
    }

    public function store(StoreComodityTabularDataRequest $request,Comodity $comodity)
    {
       $tabular_data = $comodity->tabular_data()->create([
            "title" => $request->input("title"),
            "slug" => Str::slug($request->input("title"),"-"),
            "source" => $request->input("source"),
            "description" => $request->input("description"),
            "created_at" => now(),
            "updated_at" => now()
       ]); 
        
       

        $tabular_data->json_data()->create([
            'data'=> json_encode($request->input("tableData")),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function edit(Request $request,Comodity $comodity)
    {
        
        $tabular_data = TabularData::where("tabular_dataable_id",$comodity->id)->where("tabular_dataable_type","App\Models\Comodity")->first();
        $json_data = JsonData::where("dataable_id",$tabular_data->id)->where("dataable_type","App\Models\TabularData")->first();
        
        return Inertia::render("ComodityData/Tabular/Edit",compact("comodity","tabular_data","json_data"));
    }

    public function update(StoreComodityTabularDataRequest $request,Comodity $comodity)
    {
        $tabular_data = TabularData::where("tabular_dataable_id",$comodity->id)->where("tabular_dataable_type","App\Models\Comodity")->first();

        $json_data = JsonData::where("dataable_id",$tabular_data->id)->where("dataable_type","App\Models\TabularData")->first();

        $tabular_data->update([
            "title" => $request->input("title"),
            "slug" => Str::slug($request->input("title"),"-"),
            "source" => $request->input("source"),
            "description" => $request->input("description"),
            "updated_at" => now()
        ]); 
        

        $json_data->update([
            'data'=> json_encode($request->input("tableData")),
            'updated_at' => now()
        ]);
    }

    public function destroy(Request $request,Comodity $comodity)
    {
        $tabular_data = TabularData::where("tabular_dataable_id",$comodity->id)->where("tabular_dataable_type","App\Models\Comodity")->first();
        $json_data = JsonData::where("dataable_id",$tabular_data->id)->where("dataable_type","App\Models\TabularData")->first();
        $tabular_data->delete();
        $json_data->delete();
    }
}
