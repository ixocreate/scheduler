<?php

namespace KiwiSuite\Scheduler\Console;


use KiwiSuite\Contract\Command\CommandInterface;
use KiwiSuite\Scheduler\Task\TaskMapping;
use KiwiSuite\Scheduler\Task\TaskSubManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class SchedulerExecuteCommand extends Command implements CommandInterface
{
    private $taskMapping;

    private $taskSubManager;

    private $task;

    public function __construct(TaskMapping $taskMapping, TaskSubManager $taskSubManager)
    {
        $this->taskMapping = $taskMapping;
        $this->taskSubManager = $taskSubManager;

        parent::__construct(self::getCommandName());
    }

    protected function configure()
    {
        $this
            ->setHidden(true)
            ->addArgument('name', InputArgument::REQUIRED);
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->task = $this->setUpTask($input->getArgument('name'));
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

    }

    public static function getCommandName()
    {
        return 'scheduler:exec';
    }

    private function setUpTask($taskName)
    {
        $tasks = [];
        $namespace = [];
        foreach ($this->taskMapping->getMapping() as $task) {
            $namespace[$task] = $tasks[] = ($this->taskSubManager->get($task))->getName();
        }
        $key = array_search($taskName, $namespace);
        return $this->taskSubManager->get($key);
    }

}