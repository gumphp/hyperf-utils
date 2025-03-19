<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Gump\HyperfUtils\Replace\Cache;
use Hyperf\Context\ApplicationContext;
use Hyperf\ExceptionHandler\Formatter\FormatterInterface;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Logger\LoggerFactory;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;

if (! function_exists('app')) {
    /**
     * Finds an entry of the container by its identifier and returns it.
     * @return ContainerInterface|mixed
     */
    function app(?string $id = null)
    {
        $container = ApplicationContext::getContainer();
        if ($id) {
            return $container->get($id);
        }

        return $container;
    }
}

if (! function_exists('format_throwable')) {
    /**
     * Format a throwable to string.
     */
    function format_throwable(Throwable $throwable): string
    {
        return di()->get(FormatterInterface::class)->format($throwable);
    }
}

if (! function_exists('request')) {
    /**
     * @return mixed|RequestInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    function request()
    {
        return app()->get(RequestInterface::class);
    }
}

if (! function_exists('get_client_ip')) {
    /**
     * 获取客户端IP地址
     * 需按照文档设置，通过nginx把客户端ip地址透传过来
     * https://hyperf.wiki/3.1/#/zh-cn/tutorial/nginx?id=%e9%85%8d%e7%bd%ae-http-%e4%bb%a3%e7%90%86.
     * @param mixed $default
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    function get_client_ip($default = ''): string
    {
        return request()->header('x-real-ip', $default);
    }
}

if (! function_exists('cache')) {
    /**
     * @return Cache|CacheInterface|mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    function cache()
    {
        return app()->get(CacheInterface::class);
    }
}

if (! function_exists('logger')) {
    /**
     * @return LoggerInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    function logger($group = 'default', $name = 'app')
    {
        return app()->get(LoggerFactory::class)->get($name, $group);
    }
}
