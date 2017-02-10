<?php

namespace App\Http\Middleware;

use App\Exceptions\ApplicationException;
use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class GetUserFromToken
{
    public function handle($request, Closure $next)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                throw new ApplicationException(40801);
            }
        } catch (TokenExpiredException $e) {
            throw new ApplicationException(41001);
        } catch (TokenInvalidException $e) {
            throw new ApplicationException(40701);
        } catch (JWTException $e) {
            throw new ApplicationException(40001);
        }

        return $next($request);
    }
}
