<?php
/**
 * Created by PhpStorm.
 * User: Aiden
 * Date: 2017/2/8
 * Time: 16:56
 */

namespace App\Api\Controllers;

use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;

class BaseController extends Controller
{
    use Helpers;

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

    public function responseData($data = [], $options = [])
    {
        $data['code'] = $this->getCode();
        $data['msg'] = app('error.info')->getErrorMsg($data['code']);
        return response()->json($data);
    }
}
