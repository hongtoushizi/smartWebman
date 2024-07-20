<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace app\middleware;

use library\log\SysLogger;
use support\Db;
use Tinywan\Jwt\Exception\JwtTokenException;
use Tinywan\Jwt\JwtToken;
use Webman\Context;
use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;

/**
 * Class StaticFile
 * @package app\middleware
 */
class AuthToken implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
        $uRuntimeData = [];
        // 拦截请求，返回一个重定向响应，请求停止向洋葱芯穿越
        $token = explode(' ', $request->header()['authorization'] ?? "");
        if (empty($token)) {
            throw new JwtTokenException('authorization 错误，请重新登陆');
        }
        SysLogger::getInstance()->info("authToken  token is " . json_encode($token));
        JwtToken::verify(1, $token[1] ?? "");

        //验证 是否被 冻结 is_freeze
        $user_id                 = JwtToken::getCurrentId();
        $uRuntimeData['user_id'] = $user_id;
        $this->setURuntimeData($uRuntimeData);

        $is_freeze = DB::table('gyh_users')->select('is_freeze')->where('id', $user_id)->first();

        if ($is_freeze->is_freeze == 1) {
            throw new JwtTokenException('此账号已经冻结，请联系客服');
        }
        return $handler($request); // 继续向洋葱芯穿越，直至执行控制器得到响应
    }


    private function setURuntimeData($data): void
    {
        $requestId = md5(uniqid());
        Context::set("request-id", $requestId);
        Context::set("user-id", $data["user_id"] ?? 0);
        SysLogger::getInstance()->info("set requestId   is " . $requestId);
    }
}
