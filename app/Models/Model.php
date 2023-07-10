<?php

declare(strict_types=1);

namespace App\Models;

class Model extends \Illuminate\Database\Eloquent\Model
{
    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}