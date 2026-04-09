<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginRequest;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller {
    public function login(LoginRequest $request){
        $credentials = $request->validated();
        /** @var JWTAuth $guard */
        $guard = Auth::guard('api');
        if (!$token =  $guard->attempt($credentials)) {
            return response()->json([
                'error' => 'No autorizado'
            ], 401);
        }
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $guard->factory()->getTTL() * 60,
            'user' => $guard->user(),
        ]);
    }
    public function me(){
        /** @var JWTAuth $guard */
        $guard = Auth::guard('api');
        $user = $guard->user();
        return response()->json($user);
    }
    public function logout(){
        /** @var JWTAuth $guard */
        $guard = Auth::guard('api');
        $guard->logout();
        return response()->json(['message' => 'Cierre de sesión exitoso']);
    }
    public function refresh(){
        /** @var JWTAuth $guard */
        $guard = Auth::guard('api');
        $newToken = $guard->refresh();
        return response()->json([
            'access_token' => $newToken,
            'token_type' => 'bearer',
            'expires_in' => $guard->factory()->getTTL() * 60,
            'user' => $guard->user(),
        ]);
    }
}