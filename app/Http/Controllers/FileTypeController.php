<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileType\StoreFileTypeRequest;
use App\Http\Requests\FileType\UpdateFileTypeRequest;
use App\Models\File\FileType;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FileTypeController extends Controller
{
    public function index()
    {
        $fileTypes = FileType::all();
        return Inertia::render("FileType/Index", compact("fileTypes"));
    }

    public function create()
    {
        return Inertia::render("FileType/Create");
    }

    public function store(StoreFileTypeRequest $request)
    {
        FileType::create($request->validated());
        return redirect(route("management.file-types"));
    }

    public function edit(FileType $fileType)
    {
        return Inertia::render("FileType/Edit", compact("fileType"));
    }

    public function update(UpdateFileTypeRequest $request, FileType $fileType)
    {
        $fileType->update($request->validated());
        return redirect(route("management.file-types"));
    }

    public function destroy(FileType $fileType)
    {
        $fileType->delete();
        return redirect(route("management.file-types"));
    }
}
