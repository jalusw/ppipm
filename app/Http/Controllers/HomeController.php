<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Sector;
use App\Models\Comodity;


class HomeController extends Controller
{
    public function __invoke()
    {
        $sectors = Sector::all();
        $comodities = Comodity::with('sub_sector')->get();
        return Inertia::render('Home', compact("sectors", "comodities"));
    }


}
