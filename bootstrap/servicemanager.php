<?php
declare(strict_types=1);

namespace Ixocreate\Package\Scheduler;

use Ixocreate\Package\Scheduler\Task\TaskSubManager;
use Ixocreate\ServiceManager\ServiceManagerConfigurator;

/** @var ServiceManagerConfigurator $serviceManager */
$serviceManager->addSubManager(TaskSubManager::class);
