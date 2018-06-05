<?php

namespace KiwiSuite\Scheduler\BootstrapItem;


use KiwiSuite\Contract\Application\BootstrapItemInterface;
use KiwiSuite\Contract\Application\ConfiguratorInterface;
use KiwiSuite\Scheduler\Task\TaskConfigurator;

class TaskBootstrapItem implements BootstrapItemInterface
{
    public function getConfigurator(): ConfiguratorInterface
    {
        return new TaskConfigurator();
    }

    public function getVariableName(): string
    {
        return 'task';
    }

    public function getFileName(): string
    {
        return 'task.php';
    }
}