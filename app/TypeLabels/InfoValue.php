<?php

namespace App\TypeLabels;

/**
 * @codeCoverageIgnore
 */
class InfoValue extends TypeObject
{
    const SUCCESS = 'S';
    const FAILURE = 'F';

    protected static $typeLabels = [
        self::SUCCESS => '<div class="badge badge-success label">Ẽxito</div>',
        self::FAILURE => '<div class="badge badge-danger label">Falha</div>',
    ];
}
