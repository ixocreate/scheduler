<?php
/**
 * Created by PhpStorm.
 * User: afriedrich
 * Date: 11.06.18
 * Time: 17:25
 */

namespace KiwiSuite\Scheduler;


use KiwiSuite\Scheduler\Task\TaskInterface;

class SchedulerMonitor
{
    private static $runningTasks = [];

    public static function addRunningTask(TaskInterface $task)
    {
        self::$runningTasks = $task;
    }

    public static function displayRunningTasks()
    {
        return self::$runningTasks;
    }

    public static function removeRunningTask(TaskInterface $task)
    {

    }
}