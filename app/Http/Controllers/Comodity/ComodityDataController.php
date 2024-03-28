<?php

namespace App\Http\Controllers\Comodity;

use App\Http\Controllers\Controller;
use App\Models\Comodity;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ComodityDataController extends Controller
{
    public function index(Request $request,Comodity $comodity)
    {
        if($comodity->tabular_data)
        {
            $tabular_data = $comodity->tabular_data;
        }
        return Inertia::render("ComodityData/Index",compact("comodity"));
    }
   
}
