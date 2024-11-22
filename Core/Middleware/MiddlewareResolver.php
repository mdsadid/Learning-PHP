<?php

namespace Core\Middleware;

use Exception;

class MiddlewareResolver
{
    public const array MAP = [
        'guest' => Guest::class,
        'auth'  => Auth::class,
    ];

    /**
     * @throws Exception
     */
    public static function resolve(?string $key): void
    {
        if (!$key) return;

        $middleware = static::MAP[$key];

        if (!$middleware) {
            throw new Exception("No matching middleware found for '$key'");
        }

        (new $middleware)->handle();
    }
}
