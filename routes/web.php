<?php

use App\Http\Controllers\Comodity\ComodityArticleController;
use App\Http\Controllers\Comodity\ComodityDataController;
use App\Http\Controllers\Comodity\ComodityDataTabularController;
use App\Http\Controllers\JenisPerusahaanResourceController;
use App\Http\Controllers\KecamatanResourceController;
use App\Http\Controllers\KelurahanResourceController;
use App\Http\Controllers\KemitraanController;
use App\Http\Controllers\PerusahaanResourceController;
use App\Http\Controllers\StatusPenanamanModalResourceController;
use App\Http\Controllers\UMKMResourceController;
use App\Http\Controllers\User\AuthorizeUserController;
use App\Http\Controllers\User\UserResourceController;
use App\Http\Controllers\Comodity\ComodityResourceController;
use App\Http\Controllers\Comodity\ArchiveComodityController;
use App\Http\Controllers\Comodity\ComodityLocationController;
use App\Http\Controllers\FileTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterCategoryResourceController;
use App\Http\Controllers\PermissionResourceController;
use App\Http\Controllers\SectorResourceController;
use App\Http\Controllers\SubSectorResourceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", HomeController::class)
  ->name("home");

Route::get("/dashboard", DashboardController::class)
  ->name("dashboard")
  ->middleware("auth");

Route::middleware("auth")->prefix("management")->group(function () {
  Route::middleware("can:access-with-permission, 'management.users'")->prefix("users")->group(function () {
    Route::get("/", [UserResourceController::class, "index"])->name("management.users");
    Route::get("/create", [UserResourceController::class, "create"])->name("management.users.create");
    Route::post("/create", [UserResourceController::class, "store"])->name("management.users.store");
    Route::get("/edit/{user}", [UserResourceController::class, "edit"])->name("management.users.edit");
    Route::put("/edit/{user}", [UserResourceController::class, "update"])->name("management.users.update");
    Route::delete("/{user}", [UserResourceController::class, "destroy"])->name("management.users.destroy");
  });

  Route::middleware("can:access-with-permission,'management.permissions'")->prefix("permissions")->group(function () {
    Route::get("/", [PermissionResourceController::class, "index"])->name("management.permissions");
    Route::get("/create", [PermissionResourceController::class, "create"])->name("management.permissions.create");
    Route::post("/create", [PermissionResourceController::class, "store"])->name("management.permissions.store");
    Route::get("/edit/{permission}", [PermissionResourceController::class, "edit"])->name("management.permissions.edit");
    Route::put("/edit/{permission}", [PermissionResourceController::class, "update"])->name("management.permissions.update");
    Route::delete("/{permission}", [PermissionResourceController::class, "destroy"])->name("management.permissions.destroy");
  });

  Route::middleware("can:access-with-permission,'management.sectors'")->prefix("sectors")->group(function () {
    Route::get("/", [SectorResourceController::class, "index"])->name("management.sectors");
    Route::get("/create", [SectorResourceController::class, "create"])->name("management.sectors.create");
    Route::post("/create", [SectorResourceController::class, "store"])->name("management.sectors.store");
    Route::get("/edit/{sector}", [SectorResourceController::class, "edit"])->name("management.sectors.edit");
    Route::put("/edit/{sector}", [SectorResourceController::class, "update"])->name("management.sectors.update");
    Route::delete("/{sector}", [SectorResourceController::class, "destroy"])->name("management.sectors.destroy");
  });

  // Management Sub Sector
  Route::middleware("can:access-with-permission,'management.sub-sectors'")->prefix("sub-sectors")->group(function () {
    Route::get("/", [SubSectorResourceController::class, "index"])->name("management.sub-sectors");
    Route::get("/create", [SubSectorResourceController::class, "create"])->name("management.sub-sectors.create");
    Route::post("/create", [SubSectorResourceController::class, "store"])->name("management.sub-sectors.store");
    Route::get("/edit/{sub_sector}", [SubSectorResourceController::class, "edit"])->name("management.sub-sectors.edit");
    Route::put("/edit/{sub_sector}", [SubSectorResourceController::class, "update"])->name("management.sub-sectors.update");
    Route::delete("/{sub_sector}", [SubSectorResourceController::class, "destroy"])->name("management.sub-sectors.destroy");
  });

  // Management Comodities
  Route::middleware("can:access-with-permission,'management.comodities'")->prefix("comodities")->group(function () {
    Route::get("/", [ComodityResourceController::class, "index"])->name("management.comodities");
    Route::get("/create", [ComodityResourceController::class, "create"])->name('management.comodities.create');
    Route::post("/create", [ComodityResourceController::class, "store"])->name('management.comodities.store');
    Route::get("/edit/{comodity}", [ComodityResourceController::class, "edit"])->name('management.comodities.edit');
    Route::put("/edit/{comodity}", [ComodityResourceController::class, "update"])->name('management.comodities.update');
    Route::delete("/{comodity}", [ComodityResourceController::class, "destroy"])->name("management.comodities.destroy");

    Route::get("/{comodity}/location", [ComodityLocationController::class, "index"])->name('management.comodities.location');
    Route::post("/{comodity}/location", [ComodityLocationController::class, "store"])->name('management.comodities.location');

    Route::get("/{comodity}/article", [ComodityArticleController::class, "index"])->name('management.comodities.article');
    Route::get("/{comodity}/article-preview", [ComodityArticleController::class, "show"])->name("management.comodities.article-preview");
    Route::match(["put", "post"], "/{comodity}/article", [ComodityArticleController::class, "storeOrUpdate"])->name("management.comodities.article");

    Route::get("/{comodity}/data", [ComodityDataController::class, "index"])->name("management.comodities.data");

    Route::get("/{comodity}/data-tabular/create", [ComodityDataTabularController::class, "create"])->name("management.comodities.data-tabular.create");
    Route::post("/{comodity}/data-tabular/store", [ComodityDataTabularController::class, "store"])->name("management.comodities.data-tabular.store");
    Route::get("/{comodity}/data-tabular/edit", [ComodityDataTabularController::class, "edit"])->name("management.comodities.data-tabular.edit");
    Route::put("/{comodity}/data-tabular/update", [ComodityDataTabularController::class, "update"])->name("management.comodities.data-tabular.update");
    Route::delete("/{comodity}/data-tabular/destroy", [ComodityDataTabularController::class, "destroy"])->name("management.comodities.data-tabular.destroy");
  });


  Route::middleware("can:access-with-permission,'management.comodities")->prefix("comodites-archived")->group(function () {
    Route::get("/", [ArchiveComodityController::class, "index"])->name("management.comodities.archived");
    Route::post("/{comodity}", [ArchiveComodityController::class, "archive"])->name("management.comodities.archive");
  });


  Route::middleware("can:access-with-permission,'management.master-categories'")->prefix("master-categories")->group(function () {
    Route::get("/", [MasterCategoryResourceController::class, "index"])->name("management.master-categories");
    Route::get("/create", [MasterCategoryResourceController::class, "create"])->name("management.master-categories.create");
    Route::post("/create", [MasterCategoryResourceController::class, "store"])->name("management.master-categories.store");
    Route::get("/edit/{master_category}", [MasterCategoryResourceController::class, "edit"])->name("management.master-categories.edit");
    Route::put("/edit/{master_category}", [MasterCategoryResourceController::class, "update"])->name("management.master-categories.update");
    Route::delete("/{master_category}", [MasterCategoryResourceController::class, "destroy"])->name("management.master-categories.destroy");
  });

  Route::middleware("can:access-with-permission,'management.file-types'")->prefix("file-types")->group(function () {
    Route::get("/", [FileTypeController::class, "index"])->name("management.file-types");
    Route::get("/create", [FileTypeController::class, "create"])->name("management.file-types.create");
    Route::post("/create", [FileTypeController::class, "store"])->name("management.file-types.store");
    Route::get("/edit/{fileType}", [FileTypeController::class, "edit"])->name("management.file-types.edit");
    Route::put("/edit/{fileType}", [FileTypeController::class, "update"])->name("management.file-types.update");
    Route::delete("/{fileType}", [FileTypeController::class, "destroy"])->name("management.file-types.destroy");
  });

  Route::middleware("can:access-with-permission,'management.kecamatans'")->prefix("kecamatans")->group(function () {
    Route::get("/", [KecamatanResourceController::class, "index"])->name("management.kecamatans");
    Route::get("/create", [KecamatanResourceController::class, "create"])->name("management.kecamatans.create");
    Route::post("/create", [KecamatanResourceController::class, "store"])->name("management.kecamatans.store");
    Route::get("/edit/{kecamatan}", [KecamatanResourceController::class, "edit"])->name("management.kecamatans.edit");
    Route::put("/edit/{kecamatan}", [KecamatanResourceController::class, "update"])->name("management.kecamatans.update");
    Route::delete("/{kecamatan}", [KecamatanResourceController::class, "destroy"])->name("management.kecamatans.destroy");
  });

  Route::middleware("can:access-with-permission,'management.kelurahans'")->prefix("kelurahans")->group(function () {
    Route::get("/", [KelurahanResourceController::class, "index"])->name("management.kelurahans");
    Route::get("/create", [KelurahanResourceController::class, "create"])->name("management.kelurahans.create");
    Route::post("/create", [KelurahanResourceController::class, "store"])->name("management.kelurahans.store");
    Route::get("/edit/{kelurahan}", [KelurahanResourceController::class, "edit"])->name("management.kelurahans.edit");
    Route::put("/edit/{kelurahan}", [KelurahanResourceController::class, "update"])->name("management.kelurahans.update");
    Route::delete("/{kelurahan}", [KelurahanResourceController::class, "destroy"])->name("management.kelurahans.destroy");
  });

  Route::middleware("can:access-with-permission,'management.jenis-perusahaans'")->prefix("jenis-perusahaans")->group(function () {
    Route::get("/", [JenisPerusahaanResourceController::class, "index"])->name("management.jenis-perusahaans");
    Route::get("/create", [JenisPerusahaanResourceController::class, "create"])->name("management.jenis-perusahaans.create");
    Route::post("/create", [JenisPerusahaanResourceController::class, "store"])->name("management.jenis-perusahaans.store");
    Route::get("/edit/{jenis_perusahaan}", [JenisPerusahaanResourceController::class, "edit"])->name("management.jenis-perusahaans.edit");
    Route::put("/edit/{jenis_perusahaan}", [JenisPerusahaanResourceController::class, "update"])->name("management.jenis-perusahaans.update");
    Route::delete("/{jenis_perusahaan}", [JenisPerusahaanResourceController::class, "destroy"])->name("management.jenis-perusahaans.destroy");
  });

  Route::middleware("can:access-with-permission,'management.status-penanaman-modals'")->prefix("status-penanaman-modals")->group(function () {
    Route::get("/", [StatusPenanamanModalResourceController::class, "index"])
      ->name("management.status-penanaman-modals");
    Route::get("/create", [StatusPenanamanModalResourceController::class, "create"])
      ->name("management.status-penanaman-modals.create");
    Route::post("/create", [StatusPenanamanModalResourceController::class, "store"])
      ->name("management.status-penanaman-modals.store");
    Route::get("/edit/{status}", [StatusPenanamanModalResourceController::class, "edit"])
      ->name("management.status-penanaman-modals.edit");
    Route::put("/edit/{status}", [StatusPenanamanModalResourceController::class, "update"])
      ->name("management.status-penanaman-modals.update");
    Route::delete("/{status}", [StatusPenanamanModalResourceController::class, "destroy"])
      ->name("management.status-penanaman-modals.destroy");
  });

  Route::middleware("can:access-with-permission,'management.umkms'")->prefix('umkms')->group(function () {
    Route::get('/', [UMKMResourceController::class, 'index'])->name('management.umkms');
    Route::get('/create', [UMKMResourceController::class, 'create'])->name('management.umkms.create');
    Route::post('/store', [UMKMResourceController::class, 'store'])->name('management.umkms.store');
    Route::get('/edit/{umkm}', [UMKMResourceController::class, 'edit'])->name('management.umkms.edit');
    Route::put('/update/{umkm}', [UMKMResourceController::class, 'update'])->name('management.umkms.update');
    Route::delete('/destroy/{umkm}', [UMKMResourceController::class, 'destroy'])->name('management.umkms.destroy');
  });

  Route::middleware("can:access-with-permission,'management.perusahaans'")->prefix('perusahaans')->group(function () {
    Route::get('/', [PerusahaanResourceController::class, 'index'])->name('management.perusahaans');
    Route::get('/create', [PerusahaanResourceController::class, 'create'])->name('management.perusahaans.create');
    Route::post('/store', [PerusahaanResourceController::class, 'store'])->name('management.perusahaans.store');
    Route::get('/edit/{perusahaan}', [PerusahaanResourceController::class, 'edit'])->name('management.perusahaans.edit');
    Route::put('/update/{perusahaan}', [PerusahaanResourceController::class, 'update'])->name('management.perusahaans.update');
    Route::delete('/destroy/{perusahaan}', [PerusahaanResourceController::class, 'destroy'])->name('management.perusahaans.destroy');
  });

  Route::middleware("can:access-with-permission,'management.kemitraans'")->prefix('kemitraans')->group(function () {
    Route::get('/', [KemitraanController::class, 'index'])->name('management.kemitraans');
    Route::get('/create', [KemitraanController::class, 'create'])->name('management.kemitraans.create');
    Route::post('/store', [KemitraanController::class, 'store'])->name('management.kemitraans.store');
    Route::get('/edit/{kemitraan}', [KemitraanController::class, 'edit'])->name('management.kemitraans.edit');
    Route::put('/update/{kemitraan}', [KemitraanController::class, 'update'])->name('management.kemitraans.update');
    Route::delete('/destroy/{kemitraan}', [KemitraanController::class, 'destroy'])->name('management.kemitraans.destroy');
  });
});


Route::get("/authorize/{user}", [AuthorizeUserController::class, "index"])->middleware("auth", "can:access-with-permission,'management.authorize'")->name("authorize");
Route::post("/authorize/{user}", [AuthorizeUserController::class, "store"])->middleware("auth", "can:access-with-permissino,'management.authorize'")->name("authorize");


require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/admin.php';
