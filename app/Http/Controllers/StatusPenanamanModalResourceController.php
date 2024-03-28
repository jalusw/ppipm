<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatusPenanamanModalRequest;
use App\Http\Requests\UpdateStatusPenanamanModalRequest;
use App\Models\StatusPenanamanModal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StatusPenanamanModalResourceController extends Controller
{
    public function index()
    {
        $statuses = StatusPenanamanModal::all();
        return Inertia::render("StatusPenanamanModal/Index", compact("statuses"));
    }

    public function create()
    {
        return Inertia::render("StatusPenanamanModal/Create");
    }

    public function store(StoreStatusPenanamanModalRequest $request)
    {
        StatusPenanamanModal::create($request->validated());
        return redirect(route("management.status-penanaman-modals"));
    }

    public function edit(StatusPenanamanModal $status)
    {
        return Inertia::render("StatusPenanamanModal/Edit", compact("status"));
    }

    public function update(UpdateStatusPenanamanModalRequest $request, StatusPenanamanModal $status)
    {
        $status->update($request->validated());
        return redirect(route("management.status-penanaman-modals"));
    }

    public function destroy(StatusPenanamanModal $status)
    {
        $status->delete();
        return redirect(route("management.status-penanaman-modals"));
    }
}