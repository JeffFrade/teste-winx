<?php

namespace App\TypeLabels;

/**
 * @codeCoverageIgnore
 */
class BatchValue extends TypeObject
{
    const CREATED = 'C';
    const RUNNING = 'R';
    const FINISHED = 'F';
    const WARNING = 'W';
    const ERROR = 'X';

    protected static $typeLabels = [
        self::CREATED => '<div class="badge badge-primary label">Criado</div>',
        self::RUNNING => '<div class="badge badge-warning label">Em Execução</div>',
        self::FINISHED => '<div class="badge badge-success label">Finalizado (100% Ok)</div>',
        self::WARNING => '<div class="badge badge-secondary label">Finalizado (Com Falhas)</div>',
        self::ERROR => '<div class="badge badge-danger label">Erro</div>',
    ];
}
