<?php

declare(strict_types=1);

namespace Gspider\DeWu\Spider;

use Gspider\Http\Request;
use Gspider\Support\DeWu;

class GoodsDetail extends Request
{
    protected $gateway = '/api/v1/h5/index/fire/flow/product/detailV3';

    public function spider($data)
    {
        return $this
            ->setHeader(
                [
                    'sks' => '1,xdw2',
                    'Accept-Encoding' => 'gzip,compress,br,deflate'
                ]
            )->post(
                [
                    'data' => 'BH7t8tA56hMDRZRVMd11JtzP50Su1rbw0RW9kGaXpLHxF60AviUsV3q3c3foMHLJ60Ul9n1Yyxmaq70SFTfmnw​2BBD72A241206BEE3F783A1A3106D97C764D2451834B37AD6ADF3901A0E45039DCD1B0F18CF1314B4429112558710F892168E76F05E2713523D88B39B981064B0164B32946E8F16FA46F1B62CB1FF7D5F060976A3426FD701B9152C5B133D07FE2CF445E66A9A585FAFA08955E068FE8A02B4B6F874CA6B95CA78D00B54A0572',
                ]
            );
    }
}