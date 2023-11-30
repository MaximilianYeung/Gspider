<?php

declare(strict_types=1);

namespace Gspider\ZhongMian\Spider;

use Gspider\Http\Request;

class GoodsInfo extends Request
{
    protected $gateway = '/restapi/search/item/v3';

    public function spider($data)
    {
        return $this->post($data);
    }
}