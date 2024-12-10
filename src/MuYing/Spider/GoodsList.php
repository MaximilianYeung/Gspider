<?php

declare(strict_types=1);

namespace Gspider\MuYing\Spider;

use Gspider\Http\Request;

class GoodsList extends Request
{
    protected $gateway = '/za/api/stock_spu/search';

    public function spider($data)
    {
        return $this->post($data);
    }
}