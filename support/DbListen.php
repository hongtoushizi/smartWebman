<?php

namespace support;

use support\Db;

use Webman\Bootstrap;
use library\log\SysLogger;

class DbListen implements Bootstrap
{
    public static function start($worker)
    {
        $print = false; // 是否终端打印。

        DB::listen(function ($query) use ($print) {
            $sql = $query->sql;
            foreach ($query->bindings as $binding) {
                $value = is_numeric($binding) ? $binding : "'{$binding}'";
                $sql   = preg_replace('/\?/', (string)$value, $sql, 1);
            }
            $sql = sprintf('【%s】 %s', format_duration($query->time / 1000), $sql);
            SysLogger::getInstance()->info($sql);
            if ($print) {
                dump($sql);
            }
        });
    }
}

function format_duration($seconds): string
{
    if ($seconds < 0.001) {
        return round($seconds * 1000000) . 'μs';
    } elseif ($seconds < 1) {
        return round($seconds * 1000, 2) . 'ms';
    }

    return round($seconds, 2) . 's';
}
