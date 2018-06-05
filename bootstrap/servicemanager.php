<?php
declare(strict_types=1);


use KiwiSuite\Scheduler\Task\TaskSubManager;
use KiwiSuite\ServiceManager\ServiceManagerConfigurator;

/** @var ServiceManagerConfigurator $serviceManager */

$serviceManager->addSubManager(TaskSubManager::class);