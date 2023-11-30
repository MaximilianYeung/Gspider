<?php

declare(strict_types=1);

namespace Gspider\ZhongMian\Spider;

use Gspider\Http\Request;

class GoodsList extends Request
{
    protected $gateway = '/restapi/search/list';

    public function spider($data)
    {
        return $this->post($data);
    }
}