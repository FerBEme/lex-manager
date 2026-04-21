<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
class RoleController extends Controller {
    public function index() {
        Gate::authorize('viewAny',Role::class);
        $roles = Role::getOrPaginate();
        return RoleResource::collection($roles);
    }
    public function store(StoreRoleRequest $request) {
        Gate::authorize('create',Role::class);
        $data = $request->validated();
        $role = Role::create($data);
        return RoleResource::make($role);
    }
    public function show(Role $role) {
        Gate::authorize('view',$role);
        return RoleResource::make($role);
    }
    public function update(UpdateRoleRequest $request, Role $role) {
        Gate::authorize('update',$role);
        $data = $request->validated();
        $role->update($data);
        return RoleResource::make($role);
    }
    public function destroy(Role $role) {
        Gate::authorize('delete',$role);
        $role->delete();
        return response()->noContent();
    }
}