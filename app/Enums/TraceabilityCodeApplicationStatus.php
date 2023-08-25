<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Enums;
enum TraceabilityCodeApplicationStatus: int
{
    case PendingReview = 1;
    case ApplicationDenied = 2;
    case Approved = 10;

    public function label(): string
    {
        return match ($this->value) {
            1 => '待审核',
            2 => '审核不通过',
            10 => '审核通过',
        };
    }
}
