<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Scheduler\Task;

use Ixocreate\Scheduler\Expression\SchedulerExpression;
use Ixocreate\ServiceManager\NamedServiceInterface;

interface TaskInterface extends NamedServiceInterface
{
    public function schedule(SchedulerExpression $expression);

    public function lock(): bool;
}
