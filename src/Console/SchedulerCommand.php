<?php
/**
 * Created by PhpStorm.
 * User: afriedrich
 * Date: 01.06.18
 * Time: 12:40
 */

namespace KiwiSuite\Scheduler\Console;


use Cron\CronExpression;
use KiwiSuite\Contract\Command\CommandInterface;
use KiwiSuite\Scheduler\Scheduler;
use KiwiSuite\Scheduler\Task\TaskMapping;
use KiwiSuite\Scheduler\Task\TaskSubManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

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
            $cron = CronExpression::factory($task->schedule(new Scheduler()));
            if ($cron->isDue()) {
                $process = new Process($task->task());
                $process->run();
            }
        }


    }

    public static function getCommandName()
    {
        return "scheduler:run";
    }
}