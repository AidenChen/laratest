<?php

namespace App\Http\Middleware;

use App\Contracts\ErrorInfoContract;
use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class GetUserFromToken
{
    protected $errorInfoService;

    /**
     * GetUserFromToken constructor.
     * @param $errorInfoService
     */
    public function __construct(ErrorInfoContract $errorInfoService)
    {
        $this->errorInfoService = $errorInfoService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $code = 0;
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                $code = 400004;
            }
        } catch (TokenExpiredException $e) {
            $code = 400001;
        } catch (TokenInvalidException $e) {
            $code = 404;
        } catch (JWTException $e) {
            $code = 400002;
        } finally {
            if (0 != $code) {
                return response()->json([
                    'code' => $code,
                    'msg' => $this->errorInfoService->getErrorMsg($code)
                ]);
            }
        }

//        获取附加信息
//        $token = JWTAuth::getToken();
//        $info = explode('.', $token)[1];
//        $meta = json_decode(base64_decode($info), true);
//        $request->attributes->add(compact('meta'));
        return $next($request);
    }
}
