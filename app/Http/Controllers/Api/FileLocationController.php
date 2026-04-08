<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileLocation\StoreFileLocationRequest;
use App\Http\Requests\FileLocation\UpdateFileLocationRequest;
use App\Http\Resources\FileLocationResource;
use App\Models\FileLocation;
class FileLocationController extends Controller {
    public function index() {
        $fileLocations = FileLocation::getOrPaginate();
        return FileLocationResource::collection($fileLocations);
    }
    public function store(StoreFileLocationRequest $request) {
        $data = $request->validated();
        $fileLocation = FileLocation::create($data);
        return FileLocationResource::make($fileLocation);
    }
    public function show(FileLocation $fileLocation) {
        return FileLocationResource::make($fileLocation);
    }
    public function update(UpdateFileLocationRequest $request, FileLocation $fileLocation) {
        $data = $request->validated();
        $fileLocation->update($data);
        return FileLocationResource::make($fileLocation);
    }
    public function destroy(FileLocation $fileLocation) {
        $fileLocation->delete();
        return response()->noContent();
    }
}
