<?php

declare(strict_types=1);

namespace Gspider\FreeDuty;

use Gspider\Support\Str;
use Gspider\Support\FreeDuty;
use Gspider\Exceptions\GspiderException;

class Application
{
    /**
     * 接口域名
     */
    const DOMAIN = 'https://global-mnappapi.yuwai6868.com';

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
        $application = "\\Gspider\\FreeDuty\\Spider\\{$namespace}";

        if (class_exists($application)) {
            $reuslt = (new $application)
                ->setDomain(self::DOMAIN)
                ->setHeader(
                    [
                        'X-Requested-With' => 'XMLHttpRequest'
                    ]
                )
                ->spider(...$args);

            if ($reuslt['status'] != 200) {
                throw new GspiderException($reuslt['msg'], $reuslt['status']);
            }

            if (isset($this->config['save_images_path'])) {
                return FreeDuty::saveImages($reuslt['data'], $this->config['save_images_path'], $namespace);
            }

            return $reuslt['data'];
        }

        throw new GspiderException("class \"{$namespace}\" not found");
    }
}
