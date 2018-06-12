<?php
declare(strict_types=1);

namespace KiwiSuite\Scheduler\Task;

use KiwiSuite\Scheduler\Expression\SchedulerExpression;

interface TaskInterface
{
    public static function getName(): string;

    public function schedule(SchedulerExpression $expression);

    public function lock(): bool;

}

