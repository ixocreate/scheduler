<?php
declare(strict_types=1);



/** @var ServiceManagerConfigurator $serviceManager */
use KiwiSuite\ServiceManager\ServiceManagerConfigurator;
use KiwiSuite\Scheduler\Task\TaskSubManager;

$serviceManager->addSubManager(TaskSubManager::class);