# 零关税接口调用

```
use Gspider\Factory;
$freeDuty = Factory::FreeDuty(
    [
        'save_images_path' => './images/' // 本地图片保存路径(不填则不保存)
    ]
);
```

```
// 分类
$result = $freeDuty->Category(
    [
        'mnid' => '4',
        'mn_sid' => '654',
        'cid' => '2',
        'token' => '',
    ]
);
```

```
// 商品列表
$result = $freeDuty->GoodsList(
    [
        'class_id' => '35', // 分类id 通过分类列表获取
        'sort' => '1', // 排序 1=新品(默认) 2=热门 3=价格高到低 4=价格低到高
        'limit' => '10',
        'page' => '1',
        'mnid' => '4',
        'mn_sid' => '654',
        'cid' => '2',
        'token' => '',
    ]
);
```

```
// 商品详情
$result = $freeDuty->GoodsInfo(
    [
        'goods_id' => '2740', // 商品id 通过商品列表获取
        'cid' => '2',
        'mnid' => '4',
        'mn_sid' => '654',
        'token' => '',
        'spec_num' => '1'
    ]
);
```
