<?php
declare(strict_types=1);

namespace KiwiSuite\Scheduler\Task\Tasks;


use KiwiSuite\Scheduler\Expression\SchedulerExpression;
use KiwiSuite\Scheduler\Task\TaskInterface;

class TestTask implements TaskInterface
{
    public static function getName(): string
    {
        return 'TestTask';
    }

    public function schedule(SchedulerExpression $expression): string
    {
        return $expression->everyMinute();
    }

    public function task(): string
    {
        return 'task:task-1';
    }

    public function options(): ?array
    {
        $options = array();
        return $options;
    }

    public function lock(): bool
    {
        return true;
    }

    public function log(): ?string
    {
        return null;
    }
}