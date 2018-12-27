<?php
declare(strict_types=1);

namespace Ixocreate\Scheduler;

/** @var TaskConfigurator $task */
use Ixocreate\Scheduler\Task\TaskConfigurator;
use Ixocreate\Scheduler\Task\Tasks\ExampleCallTask;
use Ixocreate\Scheduler\Task\Tasks\ExampleCommandTask;

$task->addTask(ExampleCallTask::class);
$task->addTask(ExampleCommandTask::class);
