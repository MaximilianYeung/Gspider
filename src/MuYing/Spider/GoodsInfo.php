<?php

declare(strict_types=1);

namespace Gspider\MuYing\Spider;

use Gspider\Http\Request;

class GoodsInfo extends Request
{
    protected $gateway = '/za/api/stock_spu/info';

    public function spider($data)
    {
        return $this->post($data);
    }
}