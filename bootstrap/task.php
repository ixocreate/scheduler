<?php
declare(strict_types=1);

namespace Ixocreate\Scheduler\Package;

use Ixocreate\Scheduler\Package\Task\TaskConfigurator;
use Ixocreate\Scheduler\Package\Task\ExampleCallTask;
use Ixocreate\Scheduler\Package\Task\ExampleCommandTask;

/** @var TaskConfigurator $task */
$task->addTask(ExampleCallTask::class);
$task->addTask(ExampleCommandTask::class);
