<?php

declare(strict_types=1);

namespace Gspider\FreeDuty\Spider;

use Gspider\Http\Request;

class GoodsInfo extends Request
{
    protected $gateway = '/Distribution/goodsInfo';

    public function spider($data)
    {
        return $this->get($data);
    }
}