<?php
declare(strict_types=1);

namespace Ixocreate\Scheduler;

use Ixocreate\Scheduler\Task\TaskSubManager;
use Ixocreate\ServiceManager\ServiceManagerConfigurator;

/** @var ServiceManagerConfigurator $serviceManager */
$serviceManager->addSubManager(TaskSubManager::class);
