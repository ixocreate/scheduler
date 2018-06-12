<?php
declare(strict_types=1);

/** @var TaskConfigurator $task */
use KiwiSuite\Scheduler\Task\Tasks\CountTask;
use KiwiSuite\Scheduler\Task\TaskConfigurator;

$task->addTask(CountTask::class);