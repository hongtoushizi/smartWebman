<?php

namespace app\user\controller\v1;

use support\Redis;
use support\Request;
use Webman\Medoo\Medoo;
use think\Validate;

class UserController
{
    public function index(Request $request)
    {
        $param = $request->all();
        $user  = Medoo::get('user', '*', ['uid' => 1]);


        $rule = [
            'user_id'    => 'require|number',
            'order_no'   => 'require',
            'order_type' => 'require|number|between:1,4',
            'open_id'    => 'require',
            'amount'     => 'require|number',
            'act_name'   => 'require',
            'remark'     => 'require',
            'wishing'    => 'require',
            'trace_id'   => 'require',
        ];

        $message = [
            'user_id.require' => '用户ID必传',
            'user_id.number'  => '用户ID必须是整数',
            'user_id.gt'      => '用户ID必须大于0 ',
            'open_id.require' => 'open_id必传',

        ];
        $v       = new Validate();
        if (!$v->rule($rule)->message($message)->check($param)) {
            $err = json_encode($v->getError());
            return $this->jsonError();
        }
        json("ok");
    }

    public function testRedis(Request $request)
    {
        echo "423423";

    }


}
