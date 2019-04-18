<?php
declare(strict_types=1);

namespace Ixocreate\Package\Scheduler;

use Ixocreate\Package\Scheduler\Task\TaskConfigurator;
use Ixocreate\Package\Scheduler\Task\ExampleCallTask;
use Ixocreate\Package\Scheduler\Task\ExampleCommandTask;

/** @var TaskConfigurator $task */
$task->addTask(ExampleCallTask::class);
$task->addTask(ExampleCommandTask::class);
