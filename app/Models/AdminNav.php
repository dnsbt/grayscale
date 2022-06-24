<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNav extends Model
{
    public const ADMIN_DASHBOARD = 'admin_dashboard';

    public static function getNav(): array
    {
        return [
            []
            ];
    }
}
