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

namespace Ixocreate\Scheduler\BootstrapItem;


use Ixocreate\Contract\Application\BootstrapItemInterface;
use Ixocreate\Contract\Application\ConfiguratorInterface;
use Ixocreate\Scheduler\Task\TaskConfigurator;

final class TaskBootstrapItem implements BootstrapItemInterface
{
    /**
     * @return ConfiguratorInterface
     */
    public function getConfigurator(): ConfiguratorInterface
    {
        return new TaskConfigurator();
    }

    /**
     * @return string
     */
    public function getVariableName(): string
    {
        return 'task';
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return 'task.php';
    }
}
