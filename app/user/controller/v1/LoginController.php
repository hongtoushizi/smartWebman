<?php

namespace app\user\controller\v1;

use library\log\SysLogger;
use support\Request;

class LoginController
{
    public function loginIn(Request $request)
    {
        $reg      = 0;// 注册标识 1：注册 0：登录
        $param    = $request->all();
        $rule     = [
            'openid'  => 'require',
            'unionid' => 'require'
        ];
        $message  = [];
        $validate = new BaseValidate($rule, $message);
        if (!$validate->check($param)) {
            return $this->error([], $validate->getError());
        }

        SysLogger::getInstance()->info('小程序login-yqh接口入参：' . json_encode($param));

    }

    public function loginOut(Request $request)
    {

    }

}
