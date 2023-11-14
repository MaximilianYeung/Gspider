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

# 得物接口调用 - 部分 (注意频率限制)

```
use Gspider\Factory;
$deWuTest = Factory::DeWu();
```

```
// tab分类列表
// (经过测试有登陆的功能, 如遇到提示登录可调用一次该接口)
$result = $deWuTest->init()['tabList'];

// tab分类商品
// (需要执行tab分类列表后调用, 否则长时间不调用会出现登陆提示)
$result = $deWuTest->ShoppingTab(
    [
        'limit' => 20,
        'lastId' => '', // 当前分页 默认空为第一页 翻页依次递增1
        'tabId' => 1000008 // 通过分类列表获取的id
    ]
);
```

```
// 商品主分类
$result = $deWuTest->Category();

//商品子分类
$result = $deWuTest->CategoryChildren(
    [
        'catId' => 1003183, // 分类id通过主分类接口获取
    ]
);
```