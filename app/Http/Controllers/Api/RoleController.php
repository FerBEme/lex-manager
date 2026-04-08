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
        $permissions = $data['permission'];
        unset($data['permission']);
        $role = Role::create($data);
        $role->permissions()->attach($permissions);
        return RoleResource::make($role->load('permissions'));
    }
    public function show(Role $role) {
        return RoleResource::make($role->load('permissions'));
    }
    public function update(UpdateRoleRequest $request, Role $role) {
        $data = $request->validated();
        $permissions = $data['permission'];
        unset($data['permission']);
        $role->update($data);
        $role->permissions()->sync($permissions);
        return RoleResource::make($role->load('permissions'));
    }
    public function destroy(Role $role) {
        $role->delete();
        return response()->noContent();
    }
}