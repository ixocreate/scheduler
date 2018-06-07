<?php

namespace KiwiSuite\Scheduler\Task\Tasks;


use KiwiSuite\Scheduler\Expression\SchedulerExpression;
use KiwiSuite\Scheduler\Task\TaskInterface;

class BigTask implements TaskInterface
{

    public static function getName(): string
    {
        return 'BigTask';
    }

    public function schedule(SchedulerExpression $expression)
    {
        return $expression->everyMinute();
    }

    public function task(): string
    {
        return 'task:task-big';
    }

    public function options(): ?array
    {
        return null;
    }

    public function lock(): bool
    {
        return null;
    }

    public function log(): ?string
    {
        return null;
    }
}