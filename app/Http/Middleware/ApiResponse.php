<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiResponse
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        $content = $response->getContent();
        if (is_string($content)) {
            $content = json_decode($content, true);
            if ($content && !isset($content['code']) && !isset($content['message'])) {
                $response->setContent((new \App\Http\Response($content))->toJson());
            }
        }

        return $response;
    }
}
