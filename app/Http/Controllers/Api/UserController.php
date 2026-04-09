<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller {
    public function index() {
        $users = User::getOrPaginate();
        return UserResource::collection($users);
    }
    public function store(StoreUserRequest $request) {
        $data = $request->validated();
        $roles = $data['role'];
        unset($data['role']);
        $specialties = array_filter($data['specialty'] ?? []);
        unset($data['specialty']);
        if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = Storage::put('images',$request->file('profile_photo'));
        }
        $user = User::create($data);
        $user->roles()->attach($roles);
        if (!empty($specialties)) {
            $user->specialties()->attach($specialties);
        }
        return UserResource::make($user->load(['roles','lawyer','specialties']));
    }
    public function show(User $user) {
        return UserResource::make($user->load(['roles','lawyer','specialties']));
    }
    public function update(UpdateUserRequest $request, User $user) {
        $data = $request->validated();
        $roles = $data['role'];
        unset($data['role']);
        $specialties = array_filter($data['specialty'] ?? []);
        unset($data['specialty']);
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo && Storage::exists($user->profile_photo)) {
                Storage::delete($data['profile_photo']);
            }
            $data['profile_photo'] = Storage::put('images',$request->file('profile_photo'));
        }
        $user->update($data);
        $user->roles()->sync($roles);        
        if (!empty($specialties)) {
            $user->specialties()->sync($specialties);
        }
        return UserResource::make($user->load(['roles','lawyer','specialties']));
    }
    public function destroy(User $user) {
        $user->delete();
        return response()->noContent();
    }
}