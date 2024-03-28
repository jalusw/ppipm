<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreKelurahanRequest;
use App\Http\Requests\UpdateKelurahanRequest;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KelurahanResourceController extends Controller
{
    public function index()
    {
        $kelurahans = Kelurahan::with("kecamatan")->get();
        return Inertia::render("KelurahanResource/Index", compact("kelurahans"));
    }

    public function create()
    {
        $kecamatans = Kecamatan::all();
        return Inertia::render("KelurahanResource/Create", compact("kecamatans"));
    }

    public function store(StoreKelurahanRequest $request)
    {
        $kecamatan_id = $request->input("kecamatan_id");
        $name = $request->input("name");

        Kelurahan::create([
            'kecamatan_id' => $kecamatan_id,
            'name' => $name,
        ]);

        return redirect(route("management.kelurahans"));
    }

    public function edit(Request $request, Kelurahan $kelurahan)
    {
        $kecamatans = Kecamatan::all();
        return Inertia::render("KelurahanResource/Edit", compact("kelurahan", "kecamatans"));
    }

    public function update(UpdateKelurahanRequest $request, Kelurahan $kelurahan)
    {
        $kecamatan_id = $request->input("kecamatan_id");
        $name = $request->input("name");

        $kelurahan->update([
            'kecamatan_id' => $kecamatan_id,
            'name' => $name,
        ]);

        return redirect(route("management.kelurahans"));
    }

    public function destroy(Request $request, Kelurahan $kelurahan)
    {
        $kelurahan->delete();
        return redirect(route("management.kelurahans"));
    }
}