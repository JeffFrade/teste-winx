<?php

namespace App\TypeLabels;

/**
 * @codeCoverageIgnore
 */
class ActiveValue extends TypeObject
{
    const ATIVO = 1;
    const INATIVO = 0;

    protected static $typeLabels = [
        self::ATIVO => '<div class="badge badge-success label">Ativo</div>',
        self::INATIVO => '<div class="badge badge-danger label">Inativo</div>',
    ];
}
