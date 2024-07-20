<?php

namespace library\log;

use support\Context;
use Support\Log;

class SysLogger extends Log
{
    protected static ?SysLogger $_instance     = null;
    private static array        $_context_data = [];

    public static function getInstance(): SysLogger
    {
        //检测当前类属性$instance是否已经保存了当前类的实例
        if (is_null(self::$_instance)) {
            //如果没有,则创建当前类的实例
            self::$_instance = new self();
        }
        //如果已经有了当前类实例,就直接返回,不要重复创建类实例
        self::initContext();
        return self::$_instance;
    }

    protected static function initContext(): void
    {
        $data                = [
            "request-id" => Context::get("request-id") ?? "0000000000000",
            "user-id"    => Context::get("user-id") ?? "0"
        ];
        self::$_context_data = $data;
    }

    public function debug(string $message, array $context = []): void
    {
        $context = array_merge($context, self::$_context_data);
        parent::debug($message, $context);
    }

    public function info(string $message, array $context = []): void
    {
        $context = array_merge($context, self::$_context_data);
        parent::info($message, $context);
    }

    public function notice(string $message, array $context = []): void
    {
        $context = array_merge($context, self::$_context_data);
        parent::notice($message, $context);
    }

    public function warning(string $message, array $context = []): void
    {
        $context = array_merge($context, self::$_context_data);
        parent::warning($message, $context);
    }

    public function error(string $message, array $context = []): void
    {
        $context = array_merge($context, self::$_context_data);
        parent::error($message, $context);
    }


}
