<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Scheduler\Task;

use Ixocreate\ServiceManager\NamedServiceInterface;
use Ixocreate\Package\Scheduler\Expression\SchedulerExpression;

interface TaskInterface extends NamedServiceInterface
{
    public function schedule(SchedulerExpression $expression);

    public function lock(): bool;
}
