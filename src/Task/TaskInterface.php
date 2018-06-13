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

namespace KiwiSuite\Scheduler\Task;

use KiwiSuite\Scheduler\Expression\SchedulerExpression;

interface TaskInterface
{
    public static function getName(): string;

    public function schedule(SchedulerExpression $expression);

    public function lock(): bool;

}

