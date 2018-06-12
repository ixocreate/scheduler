<?php
declare(strict_types=1);

namespace KiwiSuite\Scheduler\Task;


use KiwiSuite\Contract\Application\ConfiguratorInterface;
use KiwiSuite\Contract\Application\ServiceRegistryInterface;
use KiwiSuite\ServiceManager\Factory\AutowireFactory;
use KiwiSuite\ServiceManager\SubManager\SubManagerConfigurator;

final class TaskConfigurator implements ConfiguratorInterface
{
    private $subManagerConfigurator;

    public function __construct()
    {
        $this->subManagerConfigurator = new SubManagerConfigurator(TaskSubManager::class, TaskInterface::class);
    }

    public function getManagerConfigurator()
    {
        return $this->subManagerConfigurator;
    }

    public function addTask(string $action, string $factory = AutowireFactory::class)
    {
        $this->subManagerConfigurator->addFactory($action, $factory);
    }

    public function addDirectory(string $directory, bool $recursive)
    {
        $this->subManagerConfigurator->addDirectory($directory, $recursive);
    }

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