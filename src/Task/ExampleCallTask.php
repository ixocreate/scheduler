<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Scheduler\Package\Task;

use Ixocreate\Scheduler\Package\Expression\SchedulerExpression;

class ExampleCallTask implements TaskInterface, CallTaskInterface
{
    public function task()
    {
    }

    /**
     * @return string
     */
    public static function serviceName(): string
    {
        return 'ExampleCallTask';
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
