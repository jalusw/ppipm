<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKecamatanRequest;
use App\Http\Requests\UpdateKecamatanRequest;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Inertia\Inertia;

class KecamatanResourceController extends Controller
{
    public function index()
    {
        $kecamatans = Kecamatan::all();
        return Inertia::render("KecamatanResource/Index", compact("kecamatans"));
    }

    public function create(Request $request)
    {
        return Inertia::render("KecamatanResource/Create");
    }

    public function store(StoreKecamatanRequest $request)
    {
        $name = $request->input("name");
        $current_datetime = Carbon::now();

        Kecamatan::create([
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'created_at' => $current_datetime,
            'updated_at' => $current_datetime
        ]);

        return redirect(route("management.kecamatans"));
    }

    public function edit(Request $request, Kecamatan $kecamatan)
    {
        // Tambahkan logika untuk mengambil data yang diperlukan
        return Inertia::render("KecamatanResource/Edit", compact("kecamatan"));
    }

    public function update(UpdateKecamatanRequest $request, Kecamatan $kecamatan)
    {
        $name = $request->input("name");
        $current_datetime = Carbon::now();

        $kecamatan->update([
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'updated_at' => $current_datetime,
        ]);

        return redirect(route("management.kecamatans"));
    }

    public function destroy(Request $request, Kecamatan $kecamatan)
    {
        $kecamatan->delete();
    }
}
