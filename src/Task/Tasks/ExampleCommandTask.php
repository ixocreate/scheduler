<?php
declare(strict_types=1);

namespace KiwiSuite\Scheduler\Task\Tasks;


use KiwiSuite\Scheduler\Expression\SchedulerExpression;
use KiwiSuite\Scheduler\Task\CommandTaskInterface;
use KiwiSuite\Scheduler\Task\TaskInterface;

class ExampleCommandTask implements TaskInterface, CommandTaskInterface
{
    /**
     * @return string
     */
    public function run(): string
    {
        return 'media:generate-delegator Bla';
    }

    /**
     * @return string
     */
    public static function serviceName(): string
    {
        return 'ExampleCommandTask';
    }

    /**
     * @param SchedulerExpression $expression
     * @return string
     */
    public function schedule(SchedulerExpression $expression)
    {
        return $expression->everyMinute();
    }

    /**
     * @return bool
     */
    public function lock(): bool
    {
        return true;
    }
}