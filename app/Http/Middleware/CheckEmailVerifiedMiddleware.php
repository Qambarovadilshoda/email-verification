<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckEmailVerifiedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $this->getUser();

        if ($user && is_null($user->email_verified_at)) {
            return redirect()->route('loginForm');
        }

        return $next($request);
    }

    private function getUser()
    {
        return $_SESSION['user'] ?? null;
    }

}
