<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Enums;

enum EnterpriseType: int
{
    case StateOwnedLeadingEnterprises = 1;
    case AutonomousRegionLeadingEnterprises = 2;
    case MunicipalLevelLeadingEnterprises = 3;
    case Other = 4;

    public function label(): string
    {
        return match ($this) {
            self::StateOwnedLeadingEnterprises => '国家级龙头企业',
            self::AutonomousRegionLeadingEnterprises => '自治区级龙头企业',
            self::MunicipalLevelLeadingEnterprises => '市级龙头企业',
            self::Other => '其他',
        };
    }
}
