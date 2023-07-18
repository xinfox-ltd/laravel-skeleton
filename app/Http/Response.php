<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class Response implements Arrayable, Jsonable
{
    public function __construct(
        private readonly mixed $data = [],
        private readonly string $message = 'success',
        private readonly int $code = 200
    ) {
    }

    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'message' => $this->message,
            'data' => $this->data,
        ];
    }

    public function toJson($options = 0): bool|string
    {
        return json_encode($this->toArray(), $options);
    }
}
