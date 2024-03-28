<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJenisPerusahaanRequest;
use App\Http\Requests\UpdateJenisPerusahaanRequest;
use App\Models\JenisPerusahaan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JenisPerusahaanResourceController extends Controller
{
    public function index()
    {
        $jenisPerusahaans = JenisPerusahaan::all();
        return Inertia::render("JenisPerusahaan/Index", compact("jenisPerusahaans"));
    }

    public function create()
    {
        return Inertia::render("JenisPerusahaan/Create");
    }

    public function store(StoreJenisPerusahaanRequest $request)
    {
        // Ambil data dari request
        $name = $request->input("name");
        $description = $request->input("description");

        // Simpan data ke database
        JenisPerusahaan::create([
            'name' => $name,
            'description' => $description,
        ]);

        // Redirect ke halaman index
        return redirect(route("management.jenis-perusahaans"));
    }

    public function edit(JenisPerusahaan $jenisPerusahaan)
    {
        return Inertia::render("JenisPerusahaan/Edit", compact("jenisPerusahaan"));
    }

    public function update(UpdateJenisPerusahaanRequest $request, JenisPerusahaan $jenisPerusahaan)
    {
        // Ambil data dari request
        $name = $request->input("name");
        $description = $request->input("description");

        // Update data di database
        $jenisPerusahaan->update([
            'name' => $name,
            'description' => $description,
        ]);

        // Redirect ke halaman index
        return redirect(route("management.jenis-perusahaans"));
    }

    public function destroy(JenisPerusahaan $jenisPerusahaan)
    {
        // Hapus data dari database
        $jenisPerusahaan->delete();

        // Redirect ke halaman index
        return redirect(route("management.jenis-perusahaans"));
    }
}
