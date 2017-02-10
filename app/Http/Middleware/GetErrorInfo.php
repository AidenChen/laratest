<?php

namespace App\Http\Middleware;

use App\Contracts\ErrorInfoContract;
use Closure;

class GetErrorInfo
{
    protected $errorInfoService;

    /**
     * GetErrorInfo constructor.
     */
    public function __construct(ErrorInfoContract $errorInfoService)
    {
        $this->errorInfoService = $errorInfoService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $return = json_decode($response->getContent(), true);
        $msg = $this->errorInfoService->getErrorMsg($return['code']);
        $return['msg'] = $msg;
        $return = json_encode($return);

        return response()->json($return);
    }
}
