<?php

namespace App\Http\Controllers\Comodity;

use App\Http\Controllers\Controller;
use App\Models\Comodity;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ComodityLocationController extends Controller
{
    public function index(Request $request,Comodity $comodity)
    {
        $geojson = '{"type": "FeatureCollection", "features": [] }';

        if($comodity->geo_json != null && $comodity->geo_json->first()->json_data != null){
            $geojson = $comodity->geo_json->first()->json_data->first()->data;
        } 

        return Inertia::render("ComodityLocation/Index",compact("comodity","geojson"));
    }

    public function store(Request $request,Comodity $comodity)
    {
        $geojson = json_encode($request->input());
        $comodity_geojson = null;
        if($comodity->geo_json == null)
        {
            $comodity_geojson = $comodity->geo_json()->create([]);
        }

        if($comodity->geo_json){
            $comodity_geojson = $comodity->geo_json->first();
        }

        if($comodity_geojson->json_data == null)
        {
            $comodity_geojson->json_data()->create([
                'data' => $geojson
            ]);
            return;

        }

        $comodity_geojson->json_data->first()->update([
            'data' => $geojson
        ]);

    }
}
