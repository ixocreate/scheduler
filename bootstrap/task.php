<?php
declare(strict_types=1);

namespace Ixocreate\Scheduler;

use Ixocreate\Scheduler\Task\TaskConfigurator;
use Ixocreate\Scheduler\Task\ExampleCallTask;
use Ixocreate\Scheduler\Task\ExampleCommandTask;

/** @var TaskConfigurator $task */
$task->addTask(ExampleCallTask::class);
$task->addTask(ExampleCommandTask::class);
