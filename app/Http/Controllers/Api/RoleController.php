<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
class RoleController extends Controller {
    public function index(){
        $roles = Role::getOrPaginate();
        return RoleResource::collection($roles);
    }
    public function store(StoreRoleRequest $request) {
        $data = $request->validated();
        $role = Role::create($data);
        return RoleResource::make($role);
    }
    public function show(Role $role) {
        return RoleResource::make($role);
    }
    public function update(UpdateRoleRequest $request, Role $role) {
        $data = $request->validated();
        $role->update($data);
        return RoleResource::make($role);
    }
    public function destroy(Role $role) {
        $role->delete();
        return response()->noContent();
    }
}
