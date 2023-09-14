<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-Api-Key');

        if(!$apiKey){
            return response()->json(["message"=>"Anda tidak terautentikasi!"]);
        }

        $valid = User::where("api_key",$apiKey)->first();

        $request->attributes->add(["valid_user"=>$valid]);

        if(!$valid){
            return response()->json(["message"=>"API Key anda tidak terdaftar!"]);
        }

        return $next($request);
    }
}
