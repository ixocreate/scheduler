<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Scheduler\Package\Task;

use Ixocreate\Scheduler\Package\Expression\SchedulerExpression;

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
