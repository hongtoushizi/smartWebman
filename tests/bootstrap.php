<?php
/**
 * @desc bootstrap.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2021/11/9 18:00
 */

use Webman\Bootstrap;
use Webman\Config;

require_once __DIR__ . '/../vendor/autoload.php';

Config::load(config_path(), ['route', 'container']);
if ($timezone = config('app.default_timezone')) {
    date_default_timezone_set($timezone);
}
foreach (config('autoload.files', []) as $file) {
    include_once $file;
}
foreach (config('bootstrap', []) as $class_name) {
    /** @var Bootstrap $class_name */
    $class_name::start(null);
}