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

use Tinywan\Xhprof\XhprofMiddleware;

return [
    // 默认中间件栈'
    '' => [
        app\middleware\ActionLog::class,
        app\middleware\CrossDomain::class,
        XhprofMiddleware::class,
    ],


];