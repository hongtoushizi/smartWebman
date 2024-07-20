<?php

namespace app\middleware;

use Webman\Http\Request;
use Webman\MiddlewareInterface;
use Webman\Http\Response;
use library\log\SysLogger;


class ActionLog implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
        $start    = microtime(true);
        $response = $handler($request);
        $end      = microtime(true);
        $request->all();
        $logMessage = 'Request: ' . $request->method() . ' ' . $request->uri() . ' ';
        $logMessage .= 'Parameters: ' . json_encode($request->all()) . ' ';
        $logMessage .= 'Time: ' . round($end - $start, 6) . 's';

        $logMessage = sprintf('【%s】 %s route log', format_duration(round($end - $start, 6)), $logMessage);

        SysLogger::getInstance()->info($logMessage);
        return $response;
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
