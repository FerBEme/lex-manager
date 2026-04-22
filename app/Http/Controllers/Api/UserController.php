<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller {
    public function index() {
        Gate::authorize('viewAny',User::class);
        $userAuth = Auth::guard('api')->user();
        $query = User::query();
        if($userAuth->role_id === 1)
            $query->where('id','!=',$userAuth->id);
        elseif($userAuth->role_id === 2)
            $query->where('lawyer_id',$userAuth->id);
        else
            return response()->json(['message' => 'Forbidden'],403);
        $users = $query->getOrPaginate();
        return UserResource::collection($users);
    }
    public function store(StoreUserRequest $request) {
        Gate::authorize('create',User::class);
        $userAuth = Auth::guard('api')->user();
        $data = $request->validated();
        if($userAuth->role_id === 2) {
            $data['role_id'] = 3;
            $data['lawyer_id'] = $userAuth->id;
        }
        if($request->hasFile('profile_photo'))
            $data['profile_photo'] = Storage::put('images',$request->file('profile_photo'));
        $user = User::create($data);
        return UserResource::make($user);
    }
    public function show(User $user) {
        Gate::authorize('view',$user);
        return UserResource::make($user);
    }
    public function update(UpdateUserRequest $request, User $user) {
        Gate::authorize('update',$user);
        $userAuth = Auth::guard('api')->user();
        $data = $request->validated();
        if($userAuth->role_id === 2) {
            $data['role_id'] = 3;
            $data['lawyer_id'] = $userAuth->id;
        }
        if($request->hasFile('profile_photo')){
            if($user->profile_photo) Storage::delete($user->profile_photo);
            $data['profile_photo'] = Storage::put('images',$request->file('profile_photo'));            
        }
        $user->update($data);
        return UserResource::make($user);
    }
    public function destroy(User $user) {
        Gate::authorize('delete',$user);
        $user->delete();
        return response()->noContent();
    }
}