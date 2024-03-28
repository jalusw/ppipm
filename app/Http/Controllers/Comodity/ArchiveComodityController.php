<?php

namespace App\Http\Controllers\Comodity;

use App\Http\Controllers\Controller;
use App\Models\Comodity;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArchiveComodityController extends Controller
{

    public function index(Request $request){
        $comodities = Comodity::where("archived",1)->with("sub_sector")->where("archived",1)->get();

        return Inertia::render("ArchiveComodity/Index",compact("comodities"));
    }

    public function archive(Request $request,Comodity $comodity)
    {
        $comodity->update([
            'archived' => !$comodity->archived
        ]);
    }
}
