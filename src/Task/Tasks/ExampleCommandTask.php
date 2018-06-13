<?php
declare(strict_types=1);

namespace KiwiSuite\Scheduler\Task\Tasks;


use KiwiSuite\Scheduler\Expression\SchedulerExpression;
use KiwiSuite\Scheduler\Task\CommandTaskInterface;
use KiwiSuite\Scheduler\Task\TaskInterface;

class ExampleCommandTask implements TaskInterface, CommandTaskInterface
{

    public function run(): string
    {
        return 'some:command';
    }

    public static function getName(): string
    {
        return 'ExampleCommandTask';
    }

    public function schedule(SchedulerExpression $expression)
    {
        return $expression->everyMinute();
    }

    public function lock(): bool
    {
        return true;
    }
}