<?php
declare(strict_types=1);

namespace Ixocreate\Scheduler\Package;

use Ixocreate\Scheduler\Package\Task\TaskSubManager;
use Ixocreate\ServiceManager\ServiceManagerConfigurator;

/** @var ServiceManagerConfigurator $serviceManager */
$serviceManager->addSubManager(TaskSubManager::class);
