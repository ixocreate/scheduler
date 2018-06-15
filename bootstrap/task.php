<?php
declare(strict_types=1);

namespace KiwiSuite\Scheduler;

/** @var TaskConfigurator $task */
use KiwiSuite\Scheduler\Task\TaskConfigurator;
use KiwiSuite\Scheduler\Task\Tasks\ExampleCallTask;
use KiwiSuite\Scheduler\Task\Tasks\ExampleCommandTask;

$task->addTask(ExampleCallTask::class);
$task->addTask(ExampleCommandTask::class);