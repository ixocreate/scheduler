<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Scheduler\Package\BootstrapItem;

use Ixocreate\Application\Bootstrap\BootstrapItemInterface;
use Ixocreate\Application\ConfiguratorInterface;
use Ixocreate\Scheduler\Package\Task\TaskConfigurator;

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
