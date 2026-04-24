<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
class RoleMiddleware {
    public function handle(Request $request, Closure $next, ...$roles): Response {
        $token = $request->cookie('token');

        if (!$token) abort(403);

        $user = Auth::guard('api')->setToken($token)->authenticate();

        if (!$user || !in_array($user->role->name, $roles)) {
            abort(403);
        }
    }
}