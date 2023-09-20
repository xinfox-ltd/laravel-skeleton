<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Enums;
enum TraceabilityCodeStatus: int
{
    case PendingReview = 1;
    case Disable = 2;
    case Enable = 10;

    public function label(): string
    {
        return match ($this->value) {
            1 => '未启用',
            2 => '已禁用',
            10 => '启用',
        };
    }
}
