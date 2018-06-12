<?php
declare(strict_types=1);

namespace KiwiSuite\Scheduler\BootstrapItem;


use KiwiSuite\Contract\Application\BootstrapItemInterface;
use KiwiSuite\Contract\Application\ConfiguratorInterface;
use KiwiSuite\Scheduler\Task\TaskConfigurator;

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