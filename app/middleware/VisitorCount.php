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

use constant\SysConfig;
use library\log\SysLogger;
use support\Db;
use support\Redis;
use Tinywan\Jwt\Exception\JwtTokenException;
use Tinywan\Jwt\JwtToken;
use Webman\Context;
use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;
use constant\cache\CachePress;

/**
 * Class StaticFile
 * @package app\middleware
 */
class VisitorCount implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
        $userCountKey = CachePress::VISITOR_COUNT;
        Redis::zAdd($userCountKey, time() + SysConfig::ONLINE_TIME, Context::get('uid'));
        return $handler($request); // 继续向洋葱芯穿越，直至执行控制器得到响应
    }

}
