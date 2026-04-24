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
        if($userAuth->role_id === 1) $query->where('id','!=',$userAuth->id);
        elseif($userAuth->role_id === 2) $query->where('role_id',3)->where('lawyer_id',$userAuth->id);
        else return response()->json(['message' => 'Forbidden'],403);
        if(request('filters')){
            foreach (request('filters') as $column => $conditions) {
                foreach ($conditions as $operator => $value) {
                    if (in_array($operator,['!=','=','>','>=','<','<='])) $query->where($column,$operator,$value);
                    if ($operator === 'like') $query->where($column,'like',"%$value%");
                }
            }
        }
        if (request('select')) $query->select(explode(',',request('select')));
        if (request('sort')) {
            foreach (explode(',',request('sort')) as $sort) {
                $direction = 'asc';
                if (substr($sort,0,1) === '-') {
                    $direction = 'desc';
                    $sort = substr($sort,1);
                }
                $query->orderBy($sort,$direction);
            }
        }
        if (request('include')) $query->with(explode(',',request('include')));
        if (request('perPage')) $users = $query->paginate(request('perPage'));
        else $users = $query->get();
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
        return UserResource::make($user->load(['role','lawyer']));
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