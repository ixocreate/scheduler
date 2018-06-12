<?php
declare(strict_types=1);

namespace KiwiSuite\Scheduler\Task;


interface CommandTaskInterface
{
    public function run(): string;
}