<?php
declare(strict_types=1);

namespace KiwiSuite\Scheduler\Task;


use KiwiSuite\Scheduler\Scheduler;

class TestTask implements TaskInterface
{
    public static function getName(): string
    {
        return 'TestTask';
    }

    public function task()
    {
        return 'php fruit task:task-1';
    }

    public function schedule(Scheduler $expression): string
    {
        return $expression->everyMinute();
    }
}