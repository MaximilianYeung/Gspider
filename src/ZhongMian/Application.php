<?php

declare(strict_types=1);

namespace Gspider\ZhongMian;

use Gspider\Support\Str;
use Gspider\Support\ZhongMian;
use Gspider\Exceptions\GspiderException;

class Application
{
    /**
     * 接口域名
     */
    const DOMAIN = 'https://api.cdfsunrise.com';

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
        $application = "\\Gspider\\ZhongMian\\Spider\\{$namespace}";

        if (class_exists($application)) {
            $reuslt = (new $application)
                ->setDomain(self::DOMAIN)
                ->setHeader(
                    [
                        'X-Requested-With' => 'XMLHttpRequest',
                        'accessToken' => 'WyI5MjlFNUUyQ0Q4RjkxRDlCLUEwQjkyMzgyMERDQzUwOUEtMTg4MTAwNTU1IiwiOTI5RTVFMkNEOEY5MUQ5Qi1BMEI5MjM4MjBEQ0M1MDlBLTE4ODEwMDU1NSJd;0;ZXlKMGVYQmxJam9pZEdGeWIxOTNaV0Z3Y0NJc0ltMXZaR1ZzSWpvaWFWQm9iMjVsSURFelhIVXdNRE5qYVZCb2IyNWxNVFFzTlZ4MU1EQXpaU0lzSW5ONWMzUmxiU0k2SW1sUFV5QXhOeTR3TGpNaUxDSmhjSEJmYm1GdFpTSTZJbXhsWm05NExXOW1abWxqYVdGc0xXMXBibWx3Y205bmNtRnRJaXdpZG1WeWMybHZiaUk2SWpFdU1qRXVOaUlzSW5ObGNtbGhiRTVQSWpvaWIxOWxNMm8wYVdaU2FWZExkekpLWkMweE5GSm9lR05XTjNGSlVTSXNJbUZqWTI5MWJuUkpSQ0k2SWpreU9VVTFSVEpEUkRoR09URkVPVUl0UVRCQ09USXpPREl3UkVORE5UQTVRUzB4T0RneE1EQTFOVFVpTENKemFXZHVJam9pTlRVME9URTBZV0ZqTlRVMU9URmpaR1UxWXpObFl6QXpORFprTlRjd1lUTWlmUT09;Ym5Wc2JBbz0=;;W10=;387cb5c91dc0d69195237d5199a1e146417bda654058b7ff02a50701f51034ae6b133b5b5c413fa768a20791005b6d3e91213a7a66e7098515ad02fae92d6e41',
                        'AppVersion' => '1.21.6',
                        // 'MiniApp' => 'weapp',
                        // 'DeviceId' => 'DCB544E2087CEE28-A0B923820DCC509A-226027344',
                        // 'openid' => 'o_e3j4ifRiWKw2Jd-14RhxcV7qIQ',
                        // 'UserSystem' => 'WeChat',
                        // 'Referrer-Policy' => 'origin',
                        // 'OS' => 'IOS',
                        // 'OsVersion' => '17.0.3',
                        'device' => 'o_e3j4ifRiWKw2Jd-14RhxcV7qIQ',
                        // 'Referer' => 'https://servicewechat.com/wx82028cdb701506f3/151/page-frame.html'
                    ]
                )
                ->spider(...$args);

            if (isset($reuslt['responseHead']) && !$reuslt['responseHead']['isSuccess']) {
                throw new GspiderException($reuslt['responseHead']['resultMessage'], $reuslt['responseHead']['code']);
            }

            if (isset($this->config['save_images_path'])) {
                return ZhongMian::saveImages($reuslt, $this->config['save_images_path'], $namespace);
            }

            return $reuslt;
        }

        throw new GspiderException("class \"{$namespace}\" not found");
    }
}
