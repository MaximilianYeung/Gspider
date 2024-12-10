<?php

declare(strict_types=1);

namespace Gspider\MuYing;

use Gspider\Support\Str;
use Gspider\Support\MuYing;
use Gspider\Exceptions\GspiderException;

class Application
{
    /**
     * 接口域名
     */
    const DOMAIN = 'https://api.kumob.cn';

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
        $application = "\\Gspider\\MuYing\\Spider\\{$namespace}";

        if (class_exists($application)) {
            $reuslt = (new $application)
                ->setDomain(self::DOMAIN)
                ->setHeader(
                    [
                        'X-Requested-With' => 'XMLHttpRequest'
                    ]
                )
                ->spider(...$args);

            if ($reuslt['code'] != 200) {
                throw new GspiderException($reuslt['message'], $reuslt['code']);
            }

            if (isset($this->config['save_images_path'])) {
                return MuYing::saveImages($reuslt['data'], $this->config['save_images_path'], $namespace);
            }

            return $reuslt['data'];
        }

        throw new GspiderException("class \"{$namespace}\" not found");
    }
}
