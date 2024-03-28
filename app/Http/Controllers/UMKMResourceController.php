<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUmkmRequest;
use App\Http\Requests\UpdateUmkmRequest;
use App\Models\JenisPerusahaan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\PersonalData;
use App\Models\StatusPenanamanModal;
use App\Models\UMKM;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UmkmResourceController extends Controller
{
    public function index()
    {
        $umkms = UMKM::all();
        return Inertia::render("UMKMResource/Index", compact("umkms"));
    }

    public function create()
    {
        $kecamatan = Kecamatan::with('kelurahan')->get();
        $jenis_perusahaan = JenisPerusahaan::all();
        $status_penanaman_modal = StatusPenanamanModal::all();

        return Inertia::render("UMKMResource/Create", compact("kecamatan", "jenis_perusahaan", "status_penanaman_modal"));
    }

    public function store(StoreUmkmRequest $request)
    {
        $personalData = PersonalData::create($request->input('personal_data'));

        $umkmData = array_merge(
            $request->only(["nib", "business_name", "email", "kbli", "address", "capital", "phone_number"]),
            [
                'personal_data_id' => $personalData->id,
                'kecamatan_id' => $request->input("kecamatan_id"),
                'kelurahan_id' => $request->input("kelurahan_id"),
                'jenis_perusahaan_id' => $request->input("jenis_perusahaan_id"),
                'status_penanaman_modal_id' => $request->input("status_penanaman_modal_id"),
            ]
        );

        UMKM::create($umkmData);

        return redirect(route("management.umkms"));
    }

    public function edit($umkm)
    {
        $umkm = UMKM::with("personalData", "kelurahan.kecamatan")->findOrFail($umkm);
        $kecamatan = Kecamatan::with('kelurahan')->get();
        $jenis_perusahaan = JenisPerusahaan::all();
        $status_penanaman_modal = StatusPenanamanModal::all();

        return Inertia::render("UMKMResource/Edit", compact("umkm", "kecamatan", "jenis_perusahaan", "status_penanaman_modal"));
    }

    public function update(UpdateUmkmRequest $request, UMKM $umkm)
    {
        $umkmData = $request->only(["nib", "business_name", "email", "kbli", "address", "capital", "phone_number"]);
        $umkmData += [
            'kecamatan_id' => $request->input("kecamatan_id"),
            'kelurahan_id' => $request->input("kelurahan_id"),
            'jenis_perusahaan_id' => $request->input("jenis_perusahaan_id"),
            'status_penanaman_modal_id' => $request->input("status_penanaman_modal_id"),
        ];

        $umkm->update($umkmData);
        $umkm->personalData->update($request->input('personal_data'));

        return redirect(route("management.umkms"));
    }

    public function destroy(Umkm $umkm)
    {
        $umkm->delete();
        return redirect(route("management.umkms"));
    }
}
