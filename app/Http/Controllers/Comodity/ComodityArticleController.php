<?php

namespace App\Http\Controllers\Comodity;

use App\Http\Controllers\Controller;
use App\Models\Comodity;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class ComodityArticleController extends Controller
{
    public function index(Request $request, $comodity)
    {
        $comodity = Comodity::where('id',$comodity)->with("article_content")->first();
        return Inertia::render("ComodityArticle/Editor",compact("comodity"));
    }


    public function show(Request $request, $comodity)
    {
        $comodity = Comodity::where('id',$comodity)->with("article_content")->first();
        return Inertia::render("ComodityArticle/Preview",compact("comodity"));
    }

    public function storeOrUpdate(Request $request, Comodity $comodity)
    {
        $data = [
            'body' => $request->input("body"),
            'is_default_formatting' => $request->input("format"),
            'updated_at' => now(),
        ];

        if ($comodity->article_content === null) {
            $data['created_at'] = now();
            $comodity->article_content()->create($data);
        }

        $comodity->article_content()->first()->update($data);
    }
}
