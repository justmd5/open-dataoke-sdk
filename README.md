# open-dataoke-sdk
大淘客开放平台SDK

## 安装

```
composer require justmd5/dataoke-sdk -vvv
```

### 使用

```php
<?php

include __DIR__.'/../vendor/autoload.php';

$dataoke = new \Justmd5\DaTaoKe\DaTaoKe(['key' => 'your-key', 'secret' => 'your-secret','version'=>'v1.1.1']);

// 例子
$result = $dataoke->request('goods.get-goods-details', ['goodsId' => '603868557658']);

```
