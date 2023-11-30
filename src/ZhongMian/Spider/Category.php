<?php

declare(strict_types=1);

namespace Gspider\ZhongMian\Spider;

use Gspider\Http\Request;

class Category extends Request
{
    protected $gateway = '/restapi/search/category';

    public function spider($data)
    {
        return $this->post($data);
    }
}