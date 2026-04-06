<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileStatus\StoreFileStatusRequest;
use App\Http\Requests\FileStatus\UpdateFileStatusRequest;
use App\Http\Resources\FileStatusResource;
use App\Models\FileStatus;
class FileStatusController extends Controller {
    public function index() {
        $fileStatuses = FileStatus::getOrPaginate();
        return FileStatusResource::collection($fileStatuses);
    }
    public function store(StoreFileStatusRequest $request) {
        $data = $request->validated();
        $fileStatus = FileStatus::create($data);
        return FileStatusResource::make($fileStatus);
    }
    public function show(FileStatus $fileStatus) {
        return FileStatusResource::make($fileStatus);
    }
    public function update(UpdateFileStatusRequest $request, FileStatus $fileStatus) {
        $data = $request->validated();
        $fileStatus->update($data);
        return FileStatusResource::make($fileStatus);
    }
    public function destroy(FileStatus $fileStatus) {
        $fileStatus->delete();
        return response()->noContent();
    }
}
