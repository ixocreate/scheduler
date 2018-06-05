<?php
namespace App;

/**@var TaskConfigurator $task */
use KiwiSuite\Scheduler\Task\TaskConfigurator;
use KiwiSuite\Scheduler\Task\TestTask;

$task->addTask(TestTask::class);