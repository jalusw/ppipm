<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthenticationSessionController;

Route::middleware("guest")->group(function () {
    Route::get("/login", LoginController::class)->name("login");
    Route::post("/login", [AuthenticationSessionController::class, "login"])->name("authenticate");
});

Route::post("/logout", [AuthenticationSessionController::class, "logout"])->name("logout");