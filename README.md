# lumen-plus
lumen feature plus

## 简介

本组件是作为 Lumen 框架服务的增强

## 功能

1. 新增以下 `make` 命令

- `make:controller`
- `make:model`
- `make:factory`
- `make:command`
- `event:generate`
- `make:event`
- `make:resource`

2. 新增路由缓存命令

- `router:cache`
- `router:clear`
- `router:list`(TODO)

## 安装

执行以下命令

```bash
composer require mowangjuanzi/lumen-plus
```

注册服务提供者

```php
$app->register(Mowangjuanzi\Plus\LumenServiceProvider::class);
```

## 后续操作

**防止缓存文件被`git`追踪**

创建文件夹`bootstrap/cache`，然后创建`bootstrap/cache/.gitignore`，输入以下内容

```gitignore
*
!.gitignore
```

**加载路由**

接下来修改`bootstrap/app.php` 中加载路由的地方。

框架最开始是这样的：

```php
$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/web.php';
});
```

修改后变成这样：

```php
if (file_exists($app->basePath("bootstrap/cache/routes.php"))) {
    require_once $app->basePath("bootstrap/cache/routes.php");
} else {
    $app->router->group([
        'namespace' => 'App\Http\Controllers',
    ], function ($router) {
        require __DIR__.'/../routes/web.php';
    });
}
```

## 命令执行和查看

然后我们就可以查看命令：

```bash
$ php artisan
Laravel Framework Lumen (6.3.3) (Laravel Components ^6.0)

Usage:
  command [options] [arguments]

Options:
  -h, --help            Display this help message
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi            Force ANSI output
      --no-ansi         Disable ANSI output
  -n, --no-interaction  Do not ask any interactive question
      --env[=ENV]       The environment the command should run under
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Available commands:
  help                Displays help for a command
  list                Lists commands
  migrate             Run the database migrations
 route
  route:cache         Create a route cache file for faster route registration
  route:clear         Remove the route cache file
  route:list          List all registered routes
```

缓存路由

```bash
php artisan router:cache
```

清除路由

```bash
php artisan router:clear
```

路由列表(待完成)

```bash
php artisan router:list
```

## 反馈
有什么问题可以来 issus.
