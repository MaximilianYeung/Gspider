<?php

declare(strict_types=1);

namespace Gspider\DeWu;

use Gspider\Support\Str;
use Gspider\Support\DeWu;
use Gspider\Exceptions\GspiderException;

class Application
{
    /**
     * 接口域名
     */
    const DOMAIN = 'https://app.dewu.com';

    /**
     * 初始化配置
     *
     * @var array
     */
    private $config = [];

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function __call($name, $args)
    {
        $namespace = Str::studly($name);
        $application = "\\Gspider\\DeWu\\Spider\\{$namespace}";

        if (class_exists($application)) {
            $args[0]['sign'] = DeWu::sign($args[0] ?? []);
            $reuslt = (new $application)
                ->setDomain(self::DOMAIN)
                ->setHeader(
                    [
                        'Connection' => 'keep-alive',
                        'appVersion' => '5.19.0',
                        'X-Auth-Token' => 'Bearer eyJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE3MDAyMDYxNjAsImV4cCI6MTczMTc0MjE2MCwidXNlcklkIjoxMjcyMjQ0NDE1LCJ1c2VyTmFtZSI6IuW-l-eJqWVyLVExTDlPMEE2IiwiaXNHdWVzdCI6ZmFsc2V9.uu6anKaSTiwPiqr3xW-_OHU_Ic64HrlVgyh4bS6T_vHq-v0iZcEOB40O2Lew5UH__qHdyJaXV6xFSwBtPc-luLDs99ao7__8cLWlsKyRaOaoTloCHNWQ3NRbNxn-9KBUxZzezipv0K1GpomD9Kg-6YEKOlF17jyIdOSCQ-4Qm_FKWZUsRI9L_AliJN_W6ExYB3tCsVdbda16T3DpCJCc4raCmHNPeqUo4hHSxJN0khrIQpWlPDLGaY6_O_1bXQJSTXBlIoW5aAmTx9hWmVJwRzlKfknfVeMVjDkKEbf7E_xZQ29hlLvYwG4e8ubh-CckzgERuHMUbCJPUzElg5f0UQ',
                        'Wxapp-Login-Token' => 'd7e2b49a|0a6af6578fabfeebbd1f68fca8e6c552|5af50517|5c442ad6',
                        'wxapp-route-id' => '[object Undefined]',
                        'SK' => '9MOMOA6tQgxMfrujYzVL4sHhhaZkdPdTKbDWnZLJXie5oXtA4ls5hbm1gHOs3DrLg6b1szcqsJhezStLMCby66KAEj20',
                        'ltk' => 'KsKDwonDusKWMMKXw5rDtMKvJsKqwprCk8OxfcOmwpbCmcKiNTzCkH7DncOiXcOKKw/DiQLCrlnCscKzwqIcDsKVNGjCocO3w5E=',
                        'Referer' => 'https://servicewechat.com/wx3c12cdd0ae8b1a7b/416/page-frame.html',
                        'platform' => 'h5',
                        'AppId' => 'wxapp'
                    ]
                )
                ->spider(...$args);

            if ($reuslt['status'] != 200 || $reuslt['code'] != 200) {
                throw new GspiderException($reuslt['msg'], $reuslt['status']);
            }

            if (isset($this->config['save_images_path'])) {
                return DeWu::saveImages($reuslt['data'], $this->config['save_images_path'], $namespace);
            }

            return $reuslt['data'];
        }

        throw new GspiderException("class \"{$namespace}\" not found");
    }
}
