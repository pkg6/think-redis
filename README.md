## 安装

```
composer require tp5er/think-redis
```

## 基本配置

```
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
REDIS_PASSWD=
```

## 常规使用

> ```
> $redis = new \Predis\Client($parameters = null, $options = null);
> $redis->set('test','test');
> ```

您现在可以简单地替换最后两行：

```
$return = \tp5er\think\redis\Redis::set('test','test');
```

这将在默认连接上运行命令。 你可以运行一个命令 任何连接（参见 `defaultConnection` 设置和 `connections` 数组 配置文件）。

```
$return = \tp5er\think\redis\Redis::connection('connectionName')->set('test','test');
```

## Copyright and License


Copyright (c) 2021 wangzhiqiang
