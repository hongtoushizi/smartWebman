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

namespace app\exception;

use support\exception\BusinessException;
use support\exception\Handler;
use Throwable;

use Webman\Http\Response;
use Webman\Http\Request;
use library\log\SysLogger;

/**
 * Class StaticFile
 * @package app\middleware
 */
class BaseException extends Handler
{
    public $dontReport = [
        BusinessException::class,
    ];


    public function render(Request $request, Throwable $exception): Response
    {
         return json(['code' => 503, 'msg' => $exception->getMessage()]);
    }


}
