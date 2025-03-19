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

namespace Gump\HyperfUtils\Replace;

use Closure;
use Psr\SimpleCache\InvalidArgumentException;

use function Hyperf\Support\value;

class Cache extends \Hyperf\Cache\Cache
{
    /**
     * @param mixed $key
     * @param mixed $ttl
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function remember($key, $ttl, Closure $callback)
    {
        $value = $this->get($key);

        if (! is_null($value)) {
            return $value;
        }

        $value = $callback();

        $this->set($key, $value, value($ttl, $value));

        return $value;
    }
}
