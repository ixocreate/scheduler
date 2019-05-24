<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Scheduler;

use Ixocreate\Application\Service\ServiceManagerConfigurator;
use Ixocreate\Scheduler\Task\TaskSubManager;

/** @var ServiceManagerConfigurator $serviceManager */
$serviceManager->addSubManager(TaskSubManager::class);
