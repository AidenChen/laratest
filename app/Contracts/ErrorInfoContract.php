<?php
/**
 * Created by PhpStorm.
 * User: Aiden
 * Date: 2017/2/9
 * Time: 15:43
 */

namespace App\Contracts;

interface ErrorInfoContract
{
    public function getErrorMsg($code);
}