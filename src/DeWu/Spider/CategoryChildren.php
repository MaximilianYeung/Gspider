<?php

declare(strict_types=1);

namespace Gspider\DeWu\Spider;

use Gspider\Http\Request;

class CategoryChildren extends Request
{
    protected $gateway = '/api/v1/h5/commodity/fire/search/doCategoryDetail';

    public function spider($data)
    {
        return $this->post($data);
    }
}