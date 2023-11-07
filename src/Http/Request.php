<?php

declare(strict_types=1);

namespace Gspider\Http;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Gspider\Exceptions\GspiderException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

abstract class Request
{
    /**
     * 请求域名
     *
     * @var [type]
     */
    protected $domain;

    /**
     * 请求网关
     *
     * @var [type]
     */
    protected $gateway;

    /**
     * 请求头
     *
     * @var array
     */
    protected $header = [
        'Content-Type' => 'application/json',
        'User-Agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 MicroMessenger/8.0.42(0x18002a31) NetType/WIFI Language/zh_CN',
    ];

    public function setDomain($domain)
    {
        $this->domain = $domain;
        return $this;
    }

    public function setHeader($header)
    {
        $this->header = array_merge(
            $this->header,
            $header
        );
        return $this;
    }

    public function get(array $data, array $header = [])
    {
        return $this->request($data, $header, 'GET');
    }

    public function post(array $data, array $header = [])
    {
        return $this->request($data, $header, 'POST');
    }

    private function request(array $data = [], array $header = [], $method = 'POST')
    {
        $client = new Client(
            [
                'verify' => false,
                'timeout' => 60,
                'headers' => array_merge($this->header, $header)
            ]
        );

        try {

            $response = $client->request(
                $method,
                $this->domain .
                    $this->gateway .
                    ($method == 'GET' ?
                        '?' . http_build_query($data) :
                        ''
                    ),

                ($method == 'POST' ? [
                    RequestOptions::JSON => $data,
                ] : [])
            );
        } catch (ClientException $e) {
            throw new \Exception('客户端异常 - ' . $e->getMessage());
        } catch (ServerException $e) {
            throw new \Exception('网络异常 - ' . $e->getMessage());
        } catch (GspiderException $e) {
            throw new GspiderException('未知异常 - ' . $e->getMessage());
        }

        $bodyContent = $response->getBody()->getContents();
        if (empty($bodyContent)) {
            throw new GspiderException('接口返回空');
        }

        $bodyContent = json_decode($bodyContent, true);
        if (empty($bodyContent)) {
            throw new GspiderException('请求失败 - 数据为空');
        }

        return $bodyContent;
    }
}
