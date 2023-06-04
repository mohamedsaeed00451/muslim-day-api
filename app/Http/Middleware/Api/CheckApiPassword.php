<?php

namespace App\Http\Middleware\Api;

use App\Traits\GeneralTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiPassword
{
    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('x-api-key') != env('API_PASSWORD','00000'))
            return $this->responseMessage(401,false,'UnAuthenticated');
        return $next($request);
    }
}
