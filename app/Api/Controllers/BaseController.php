<?php
/**
 * Created by PhpStorm.
 * User: Aiden
 * Date: 2017/2/8
 * Time: 16:56
 */

namespace App\Api\Controllers;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected $code = 0;

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function responseError($type, $options = [])
    {
        $return = [
            'code' => $this->getCode(),
            'msg' => app('error.info')->getErrorMsg($this->getCode(), request()->headers->get('lang'))
        ];

        if ($type) {
            $return['notify'] = app('error.info')->getErrorNotify($type, $options, request()->headers->get('lang'));
        }

        return response()->json($return);
    }

    public function responseData($input = [])
    {
        return response()->json([
            'code' => $this->getCode(),
            'msg' => app('error.info')->getErrorMsg($this->getCode(), request()->headers->get('lang')),
            'data' => $input
        ]);
    }
}
