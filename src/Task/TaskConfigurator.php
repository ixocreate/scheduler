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


use KiwiSuite\Contract\Application\ConfiguratorInterface;
use KiwiSuite\Contract\Application\ServiceRegistryInterface;
use KiwiSuite\ServiceManager\Factory\AutowireFactory;
use KiwiSuite\ServiceManager\SubManager\SubManagerConfigurator;

final class TaskConfigurator implements ConfiguratorInterface
{
    /**
     * @var SubManagerConfigurator
     */
    private $subManagerConfigurator;

    /**
     * TaskConfigurator constructor.
     */
    public function __construct()
    {
        $this->subManagerConfigurator = new SubManagerConfigurator(TaskSubManager::class, TaskInterface::class);
    }

    /**
     * @return SubManagerConfigurator
     */
    public function getManagerConfigurator()
    {
        return $this->subManagerConfigurator;
    }

    /**
     * @param string $action
     * @param string $factory
     */
    public function addTask(string $action, string $factory = AutowireFactory::class)
    {
        $this->subManagerConfigurator->addFactory($action, $factory);
    }

    /**
     * @param string $directory
     * @param bool $recursive
     */
    public function addDirectory(string $directory, bool $recursive)
    {
        $this->subManagerConfigurator->addDirectory($directory, $recursive);
    }

    /**
     * @return TaskMapping
     */
    public function getTaskMapping()
    {
        $config = $this->subManagerConfigurator;

        $factories = $config->getServiceManagerConfig()->getFactories();

        $taskMapping = [];
        foreach ($factories as $id => $factory) {
            if (!\is_subclass_of($id, TaskInterface::class, true)) {
                throw new \InvalidArgumentException(\sprintf("'%s' doesn't implement '%s'", $id, TaskInterface::class));
            }
            $name = \forward_static_call([$id, 'getName']);
            $taskMapping[$name] = $id;
        }

        return new TaskMapping($taskMapping);
    }
    /**
     * @param ServiceRegistryInterface $serviceRegistry
     */
    public function registerService(ServiceRegistryInterface $serviceRegistry): void
    {
        $serviceRegistry->add(TaskMapping::class, $this->getTaskMapping());
        $this->subManagerConfigurator->registerService($serviceRegistry);
    }
}