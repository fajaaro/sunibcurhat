<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class CheckAdminOrAuthor
{
    public function handle($request, Closure $next)
    {
        $user = User::where('api_token', $request->bearerToken())->first();

        $request->merge([
            'user' => $user,
        ]);

        return $next($request);
    }
}
