<?php

namespace app\activity\controller\v1;

use support\Redis;
use support\Request;
use Webman\Medoo\Medoo;

class UserController
{
    public function index(Request $request)
    {
        $user = Medoo::get('user', '*', ['uid' => 1]);


        $rule = [
            'name'  => 'require|max:25',
            'age'   => 'number|between:1,120',
            'email' => 'email'
        ];

        $message = [
            'name.require' => '名称必须',
            'name.max'     => '名称最多不能超过25个字符',
            'age.number'   => '年龄必须是数字',
            'age.between'  => '年龄只能在1-120之间',
            'email'        => '邮箱格式错误',
        ];
        response("ok");
    }

    public function testRedis(Request $request)
    {
        echo "423423";

    }


}
