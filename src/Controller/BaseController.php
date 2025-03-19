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

namespace Gump\HyperfUtils\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;

class BaseController
{
    #[Inject]
    protected ContainerInterface $container;

    #[Inject]
    protected RequestInterface $request;

    #[Inject]
    protected ResponseInterface $response;

    public function success(mixed $data = [], array $additional = [], string $message = 'success', int $code = 200)
    {
        return $this->response->json(array_merge([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $additional));
    }

    public function fail(string $message = 'fail', int $code = 500, mixed $data = [], array $additional = [])
    {
        return $this->response->json(array_merge([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $additional));
    }
}
