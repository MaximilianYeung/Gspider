<?php

declare(strict_types=1);

namespace Gspider\DeWu\Spider;

use Gspider\Http\Request;

class Category extends Request
{
    protected $gateway = '/api/v1/h5/commodity/fire/search/getCategory';

    public function spider($data)
    {
        return $this->post($data);
    }
}