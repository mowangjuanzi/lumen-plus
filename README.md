# lumen-plus
lumen feature plus

## 简介

本组件是作为 Lumen 框架服务的增强

## 功能

1. 新增以下 `make` 命令

- `make:controller`
- `make:model`
- `make:factory`

## 安装

执行以下命令

```bash
composer require mowangjuanzi/lumen-plus
```

注册服务提供者

```php
$app->register(Mowangjuanzi\Plus\LumenServiceProvider::class);
```
