<?php

namespace App\Helpers;

class IniHelper
{
    public static function setMemoryIniVars()
    {
        set_time_limit(-1);
        ini_set('memory_limit', '-1');
    }
}
