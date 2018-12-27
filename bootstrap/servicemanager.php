<?php
declare(strict_types=1);

namespace Ixocreate\Scheduler;

/** @var ServiceManagerConfigurator $serviceManager */
use Ixocreate\ServiceManager\ServiceManagerConfigurator;
use Ixocreate\Scheduler\Task\TaskSubManager;

$serviceManager->addSubManager(TaskSubManager::class);
