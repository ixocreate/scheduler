<?php
/**
 * kiwi-suite/media (https://github.com/kiwi-suite/scheduler)
 *
 * @package kiwi-suite/scheduler
 * @see https://github.com/kiwi-suite/scheduler
 * @copyright Copyright (c) 2010 - 2018 kiwi suite GmbH
 * @license MIT License
 */
declare(strict_types=1);

namespace Ixocreate\Scheduler\Console;

use Cocur\BackgroundProcess\BackgroundProcess;
use Cron\CronExpression;
use Ixocreate\Contract\Command\CommandInterface;
use Ixocreate\Scheduler\Task\TaskInterface;
use Ixocreate\Scheduler\Task\TaskSubManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Ixocreate\Scheduler\Expression\SchedulerExpression;



final class SchedulerRun extends Command implements CommandInterface
{
    /**
     * @var TaskSubManager
     */
    private $taskSubManager;

    /**
     * @var TaskInterface
     */
    private $task;


    /**
     * SchedulerRun constructor.
     * @param TaskMapping $taskMapping
     * @param TaskSubManager $taskSubManager
     */
    public function __construct(TaskSubManager $taskSubManager)
    {
        $this->taskSubManager = $taskSubManager;
        parent::__construct(self::getCommandName());
    }

    protected function configure()
    {
        $this->setDescription('Run Cron');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach ($this->taskSubManager->getServiceManagerConfig()->getNamedServices() as $tasks) {
            $this->task = $this->taskSubManager->get($tasks);
            $taskName = $this->task->serviceName();
            $cron = CronExpression::factory($this->task->schedule(new SchedulerExpression()));
            if ($cron->isDue()) {
                $process = new BackgroundProcess('php fruit scheduler:exec '.$taskName);
                $process->run();
            }
        }
    }

    /**
     * @return string
     */
    public static function getCommandName()
    {
        return "scheduler:run";
    }


}
