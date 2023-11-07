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
                        'Wxapp-Login-Token' => '',
                        'wxapp-route-id' => '[object Undefined]',
                        'SK' => '9MOMOA6tQgxMfrujYzVL4sHhhaZkdPdTKbDWnZLJXie5oXtA4ls5hbm1gHOs3DrLg6b1szcqsJhezStLMCby66KAEj20',
                        'ltk' => 'IMK+wpbDm8O5F8K/w4zDt8KFHsKxwrfDn8OsAsOmwpfCkMKrNDjClnvDmcOiXcOKKw/DiQLCrlnCscKzwqIcDsKVNGjCocO3w5E=',
                        'Referer' => 'https://servicewechat.com/wx3c12cdd0ae8b1a7b/416/page-frame.html',
                        'platform' => 'h5',
                        'AppId' => 'wxapp'
                    ]
                )
                ->spider(...$args);

            if ($reuslt['status'] != 200 || $reuslt['code'] != 200) {
                throw new GspiderException($reuslt['msg'], $reuslt['status']);
            }

            return $reuslt['data'];
        }

        throw new GspiderException("class \"{$namespace}\" not found");
    }
}
