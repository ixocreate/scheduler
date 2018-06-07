<?php
namespace App;

/**@var TaskConfigurator $task */
use KiwiSuite\Scheduler\Task\Tasks\BigTask;
use KiwiSuite\Scheduler\Task\TaskConfigurator;
use KiwiSuite\Scheduler\Task\Tasks\TestTask;

$task->addTask(TestTask::class);
$task->addTask(BigTask::class);