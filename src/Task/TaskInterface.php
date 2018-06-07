<?php
declare(strict_types=1);

namespace KiwiSuite\Scheduler\Task;

use KiwiSuite\Scheduler\Expression\SchedulerExpression;
use KiwiSuite\Scheduler\Expression\SchedulerOperation;

interface TaskInterface
{
    public static function getName(): string;

    public function schedule(SchedulerExpression $expression);

    public function task(): string;

    public function options(): ?array;

    public function lock(): bool;

    public function log(): ?string;
}

