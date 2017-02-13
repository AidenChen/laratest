<?php
/**
 * Created by PhpStorm.
 * User: Aiden
 * Date: 2017/2/9
 * Time: 15:47
 */

namespace App\Services;

use App\Contracts\ErrorInfoContract;

class ErrorInfoService implements ErrorInfoContract
{
    private $msgCn = [
        0 => '请求成功！',
        40000 => '错误信息未定义！',
        40001 => '用户认证失败！',
        40002 => '用户名或密码错误！',
        40100 => '参数不完整！',
        40200 => '参数包含空值！',
        40300 => '参数超过限制！',
        40400 => '参数未达到要求！',
        40500 => '参数不合法！',
        40600 => '无效的参数值！',
        40700 => '对象不合法！',
        40701 => '令牌不合法！',
        40800 => '对象不存在！',
        40801 => '用户不存在！',
        40900 => '对象已存在！',
        41000 => '对象已过期！',
        41001 => '令牌已过期！',
        41100 => '对象已被禁止！',
        41200 => '操作未授权！',
        50000 => '内部服务器错误！',
        50001 => '创建令牌失败！',
        50100 => '数据操作失败！',
        50101 => '数据添加失败！',
        50102 => '数据删除失败！',
        50103 => '数据更新失败！',
        50104 => '数据查询失败！',
    ];

    private $msgEn = [
        0 => 'Request successful!',
        40000 => 'Undefined error!',
        40001 => 'Undefined error!',
        40002 => 'Undefined error!',
        40701 => 'Undefined error!',
        40800 => 'Undefined error!',
        40801 => 'Undefined error!',
        41001 => 'Undefined error!',
        50000 => 'Internal server error!',
        50001 => 'Internal server error!',
        50100 => 'Internal server error!',
        50101 => 'Internal server error!',
        50102 => 'Internal server error!',
        50103 => 'Internal server error!',
        50104 => 'Internal server error!',
    ];

    private $notifyCn = [
        'test.word' => '已尝试 :time 次，将在 :min 分钟后解锁！'
    ];

    private $notifyEn = [
        'test.word' => 'yi chang shi :time ci, jiang zai :min fen zhong hou jie suo!'
    ];

    public function getErrorMsg($code, $lang = 'cn')
    {
        if ('cn' == $lang) {
            return $this->msgCn[$code];
        } else {
            return $this->msgEn[$code];
        }
    }

    public function getErrorNotify($type, $options = [], $lang = 'cn')
    {
        if ('cn' == $lang) {
            $notify = $this->notifyCn[$type];
        } else {
            $notify = $this->notifyEn[$type];
        }

        switch ($type) {
            case 'test.word':
                $notify = str_replace(':time',$options['time'],$notify);
                $notify = str_replace(':min',$options['min'],$notify);
                break;
        }

        return $notify;
    }
}