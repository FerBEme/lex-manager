<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\StorePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
class PermissionController extends Controller {
    public function index() {
        $permissions = Permission::getOrPaginate();
        return PermissionResource::collection($permissions);
    }
    public function store(StorePermissionRequest $request) {
        $data = $request->validated();
        $permission = Permission::create($data);
        return PermissionResource::make($permission);
    }
    public function show(Permission $permission) {
        return PermissionResource::make($permission);
    }
    public function update(UpdatePermissionRequest $request, Permission $permission) {
        $data = $request->validated();
        $permission->update($data);
        return PermissionResource::make($permission);
    }
    public function destroy(Permission $permission) {
        $permission->delete();
        return response()->noContent();
    }
}