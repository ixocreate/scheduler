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

namespace Ixocreate\Scheduler\Task;

use Ixocreate\Contract\ServiceManager\NamedServiceInterface;
use Ixocreate\Scheduler\Expression\SchedulerExpression;

interface TaskInterface extends NamedServiceInterface
{
    public function schedule(SchedulerExpression $expression);

    public function lock(): bool;

}

