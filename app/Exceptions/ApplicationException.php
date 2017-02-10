<?php
/**
 * Created by PhpStorm.
 * User: Aiden
 * Date: 2017/2/10
 * Time: 14:42
 */

namespace App\Exceptions;

class ApplicationException extends \Exception
{
    private $errorCode;

    /**
     * ApplicationException constructor.
     * @param $errorCode
     */
    public function __construct($errorCode)
    {
        $this->errorCode = $errorCode;
    }

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }
}
