<?php
declare(strict_types=1);

namespace KiwiSuite\Scheduler\Task;

use KiwiSuite\Scheduler\Scheduler;

interface TaskInterface
{
    public static function getName(): string;

    public function schedule(Scheduler $expression);

    public function task();
}

