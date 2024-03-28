<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKemitraanRequest;
use App\Http\Requests\UpdateKemitraanRequest;
use App\Models\Kemitraan;
use App\Models\Perusahaan;
use App\Models\UMKM;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KemitraanController extends Controller
{
    public function index()
    {
        $daftar_kemitraan = Kemitraan::with("umkm", "perusahaan")->get();
        return Inertia::render("Kemitraan/Index", compact("daftar_kemitraan"));
    }

    public function create(Request $request)
    {
        $perusahaans = Perusahaan::all();
        $umkms = UMKM::all();
        return Inertia::render("Kemitraan/Create", compact("perusahaans", "umkms"));
    }

    public function store(StoreKemitraanRequest $request)
    {
        $umkmId = $request->input("umkm_id");
        $perusahaanId = $request->input("perusahaan_id");
        $partnershipForm = $request->input("partnership_form");
        $description = $request->input("description");
        $startOfPartnership = $request->input("start_of_partnership");
        $endOfPartnership = $request->input("end_of_partnership");
        $partnershipStatus = $request->input("partnership_status");
        $currentDateTime = now();

        Kemitraan::create([
            'umkm_id' => $umkmId,
            'perusahaan_id' => $perusahaanId,
            'partnership_form' => $partnershipForm,
            'description' => $description,
            'start_of_partnership' => $startOfPartnership,
            'end_of_partnership' => $endOfPartnership,
            'partnership_status' => $partnershipStatus,
            'created_at' => $currentDateTime,
            'updated_at' => $currentDateTime
        ]);

        return redirect(route("management.kemitraans"));
    }

    public function edit(Request $request, Kemitraan $kemitraan)
    {
        $perusahaans = Perusahaan::all();
        $umkms = UMKM::all();
        return Inertia::render("Kemitraan/Edit", compact("perusahaans", "umkms", "kemitraan"));
    }

    public function update(UpdateKemitraanRequest $request, Kemitraan $kemitraan)
    {
        $partnershipForm = $request->input("partnership_form");
        $description = $request->input("description");
        $startOfPartnership = $request->input("start_of_partnership");
        $endOfPartnership = $request->input("end_of_partnership");
        $partnershipStatus = $request->input("partnership_status");
        $currentDateTime = now();

        $kemitraan->update([
            'partnership_form' => $partnershipForm,
            'description' => $description,
            'start_of_partnership' => $startOfPartnership,
            'end_of_partnership' => $endOfPartnership,
            'partnership_status' => $partnershipStatus,
            'updated_at' => $currentDateTime,
        ]);
        return redirect(route("management.kemitraans"));
    }

    public function destroy(Request $request, Kemitraan $kemitraan)
    {
        $kemitraan->delete();
        return redirect(route("management.kemitraans"));
    }
}
