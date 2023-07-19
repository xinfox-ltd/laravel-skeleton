<?php

/*
 * Copyright (c) 2023. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

declare(strict_types=1);

use Illuminate\Http\Response;

function success(mixed $data = [], string $message = 'SUCCESS', int $code = 200): Response
{
    return \Illuminate\Support\Facades\Response::make(new \App\Http\Response($data, $message, $code));
}
