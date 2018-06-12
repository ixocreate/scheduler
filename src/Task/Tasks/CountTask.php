<?php

namespace KiwiSuite\Scheduler\Task\Tasks;


use KiwiSuite\Media\Repository\MediaRepository;
use KiwiSuite\Scheduler\Expression\SchedulerExpression;
use KiwiSuite\Scheduler\Task\TaskInterface;
use KiwiSuite\Scheduler\Task\CallTaskInterface;

class CountTask implements TaskInterface, CallTaskInterface
{
    private $mediaRepository;

    public function __construct(MediaRepository $mediaRepository)
    {
        $this->mediaRepository = $mediaRepository;
    }

    public static function getName(): string
    {
        return 'CountTask';
    }

    public function schedule(SchedulerExpression $expression)
    {
        return $expression->everyMinute();
    }

    public function task()
    {
        chdir(getcwd() . '/scheduler/');
        $file = fopen('task-big.txt', 'a');

        for ($i = 0; $i <= 20; $i++) {
            fwrite($file, $i . ' --- ' . \date("h:i:sa") . PHP_EOL);
            sleep(1);
        }
        fclose($file);
    }

    public function lock(): bool
    {
        return true;
    }
}