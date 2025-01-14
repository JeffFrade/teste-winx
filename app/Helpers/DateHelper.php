<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;

class DateHelper
{
    public static function convertDate(?string $date)
    {
        if (!is_null($date)) {
            return Carbon::parse($date)->format('d/m/Y');
        }

        return null;
    }
}
