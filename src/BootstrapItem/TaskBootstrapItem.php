<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Scheduler\BootstrapItem;

use Ixocreate\Application\BootstrapItemInterface;
use Ixocreate\Application\ConfiguratorInterface;
use Ixocreate\Package\Scheduler\Task\TaskConfigurator;

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
