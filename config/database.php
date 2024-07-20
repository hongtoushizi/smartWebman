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

return [
    // 默认数据库
    'default'     => 'mysql',
    // 各种数据库配置
    'connections' => [

        'mysql' => [
            'driver'      => 'mysql',
            // 'host'        => 'sh-cdb-gelid84k.sql.tencentcdb.com',
            // 'port'        => 63573,
            'host'        => "110.40.147.117",
            'port'        => 3306,
            'database'    => "bwc",
            'username'    => "root",
            'password'    => "aW5FXYXDyzccSjJy",
            'unix_socket' => '',
            'charset'     => 'utf8mb4',
            'collation'   => 'utf8mb4_unicode_ci',
            'prefix'      => '',
            'strict'      => true,
            'engine'      => null,
            'options'     => [
                PDO::ATTR_TIMEOUT => 10,
            ],
        ],
    ]
];