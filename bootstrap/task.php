<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Scheduler;

use Ixocreate\Scheduler\Task\ExampleCallTask;
use Ixocreate\Scheduler\Task\ExampleCommandTask;
use Ixocreate\Scheduler\Task\TaskConfigurator;

/** @var TaskConfigurator $task */
$task->addTask(ExampleCallTask::class);
$task->addTask(ExampleCommandTask::class);
