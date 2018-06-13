<?php
/**
 * kiwi-suite/media (https://github.com/kiwi-suite/scheduler)
 *
 * @package kiwi-suite/scheduler
 * @see https://github.com/kiwi-suite/scheduler
 * @copyright Copyright (c) 2010 - 2018 kiwi suite GmbH
 * @license MIT License
 */
declare(strict_types=1);

namespace KiwiSuite\Scheduler\Task\Tasks;


use KiwiSuite\Scheduler\Expression\SchedulerExpression;
use KiwiSuite\Scheduler\Task\CallTaskInterface;
use KiwiSuite\Scheduler\Task\TaskInterface;

class ExampleCallTask implements TaskInterface, CallTaskInterface
{

    public function task()
    {

    }

    public static function getName(): string
    {
        return 'ExampleCallTask';
    }

    public function schedule(SchedulerExpression $expression)
    {
        return $expression->everyFiveMinutes();
    }

    public function lock(): bool
    {
        return true;
    }
}