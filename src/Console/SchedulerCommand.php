<?php

namespace KiwiSuite\Scheduler\Console;


use Cocur\BackgroundProcess\BackgroundProcess;
use Cron\CronExpression;
use KiwiSuite\Contract\Command\CommandInterface;
use KiwiSuite\Scheduler\Task\TaskMapping;
use KiwiSuite\Scheduler\Task\TaskSubManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use KiwiSuite\Scheduler\Expression\SchedulerExpression;


class SchedulerCommand extends Command implements CommandInterface
{
    private $taskMapping;

    private $taskSubManager;

    public function __construct(TaskMapping $taskMapping, TaskSubManager $taskSubManager)
    {
        $this->taskMapping = $taskMapping;
        $this->taskSubManager = $taskSubManager;

        parent::__construct(self::getCommandName());
        $this->setDescription('Run Cron');
    }

    protected function configure()
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach ($this->taskMapping->getMapping() as $tasks) {
            $task = $this->taskSubManager->get($tasks);
            $taskName = $task->getName();
            $cron = CronExpression::factory($task->schedule(new SchedulerExpression()));
            if ($cron->isDue()) {
                $process = new BackgroundProcess('php fruit scheduler:exec '.$taskName);
                $process->run();
            }
        }
    }

    public static function getCommandName()
    {
        return "scheduler:run";
    }
}