<?php
namespace App\Http\Controllers;

use App\Http\Requests\StorePerusahaanRequest;
use App\Http\Requests\UpdatePerusahaanRequest;
use App\Models\JenisPerusahaan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\PersonalData;
use App\Models\StatusPenanamanModal;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PerusahaanResourceController extends Controller
{
    public function index()
    {
        $perusahaans = Perusahaan::all();
        return Inertia::render("PerusahaanResource/Index", compact("perusahaans"));
    }

    public function create()
    {

        $kecamatan = Kecamatan::with('kelurahan')->get();
        $jenis_perusahaans = JenisPerusahaan::all();

        return Inertia::render(
            "PerusahaanResource/Create",
            compact(
                "jenis_perusahaans",
                "kecamatan"
            )
        );
    }

    public function store(StorePerusahaanRequest $request)
    {
        $personalData = PersonalData::create($request->input('personal_data'));

        $perusahaanData = array_merge(
            $request->only(["business_name", "email", "phone_number", "address"]),
            [
                'personal_data_id' => $personalData->id,
                'kecamatan_id' => $request->input("kecamatan_id"),
                'kelurahan_id' => $request->input("kelurahan_id"),
                'jenis_perusahaan_id' => $request->input("jenis_perusahaan_id"),
            ]
        );

        Perusahaan::create($perusahaanData);

        return redirect(route("management.perusahaans"));
    }

    public function edit($perusahaan)
    {
        $perusahaan = Perusahaan::with(
            "personalData",
            "kelurahan.kecamatan",
            "jenisPerusahaan"
        )->findOrFail($perusahaan);
        $kecamatan = Kecamatan::with('kelurahan')->get();
        $jenis_perusahaans = JenisPerusahaan::all();
        $status_penanaman_modals = StatusPenanamanModal::all();

        return Inertia::render(
            "PerusahaanResource/Edit",
            compact(
                "perusahaan",
                "kecamatan",
                "jenis_perusahaans",
                "status_penanaman_modals"
            )
        );
    }

    public function update(UpdatePerusahaanRequest $request, Perusahaan $perusahaan)
    {
        $perusahaanData = $request->only(["business_name", "email", "phone_number", "address"]);
        $perusahaanData += [
            'kelurahan_id' => $request->input("kelurahan_id"),
            'kecamatan_id' => $request->input("kecamatan_id"),
            'jenis_perusahaan_id' => $request->input("jenis_perusahaan_id"),
        ];

        $perusahaan->update($perusahaanData);
        $perusahaan->personalData->update($request->input('personal_data'));

        return redirect(route("management.perusahaans"));
    }

    public function destroy(Perusahaan $perusahaan)
    {
        $perusahaan->delete();
        return redirect(route("management.perusahaans"));
    }
}