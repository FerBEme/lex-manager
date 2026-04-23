<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller {
    public function login(Request $request){
        $credentials = $request->only(['email','password']);
        if(!$token = Auth::guard('api')->attempt($credentials)) return response()->json(['message' => 'Credenciales Incorrectas'],401);
        $userAuth = Auth::guard('api')->user();
        if(!$userAuth->is_active) return response()->json(['message' => 'El usuario no está activo'],401);
        return $this->respondWithToken($token);
    }
    public function me(){
        /** @var JWTAuth $guard */
        $guard = Auth::guard('api');
        return UserResource::make($guard->user());
    }
    public function logout(){
        Auth::guard('api')->logout();
        return response()->json(['message' => 'Sesión Cerrada']);
    }
    public function refresh(){
        /** @var JWTAuth $guard */
        $guard = Auth::guard('api');
        return $this->respondWithToken($guard->refresh());
    }
    private function respondWithToken($token){
        /** @var JWTAuth $guard */
        $guard = Auth::guard('api');
        $user = $guard->user()->load('role');
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $guard->factory()->getTTL() * 60,
            'userAuth' => UserResource::make($guard->user()),
            'role' => $user->role->name,
        ]);
    }
}