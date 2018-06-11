<?php

namespace KiwiSuite\Scheduler\Console;


use Cocur\BackgroundProcess\BackgroundProcess;
use KiwiSuite\Contract\Command\CommandInterface;
use KiwiSuite\Scheduler\SchedulerMonitor;
use KiwiSuite\Scheduler\Task\TaskInterface;
use KiwiSuite\Scheduler\Task\TaskMapping;
use KiwiSuite\Scheduler\Task\TaskSubManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Lock\Factory;
use Symfony\Component\Lock\Lock;
use Symfony\Component\Lock\Store\SemaphoreStore;
use Symfony\Component\Process\Process;


class SchedulerExecuteCommand extends Command implements CommandInterface
{
    /**
     * @var TaskMapping
     */
    private $taskMapping;

    /**
     * @var TaskSubManager
     */
    private $taskSubManager;

    /**
     * @var TaskInterface
     */
    private $task;

    /**
     * @var BackgroundProcess
     */
    private $process;

    /**
     * @var Lock
     */
    private $lock;

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
        $command = $this->buildCommand();
        $this->process = new Process($command);
        if (($this->task)->lock() && $this->lock === null) {
            $this->setUpLock();
        }
        if ($this->lock->isAcquired()) {
            return;
        }
        $this->lock->acquire();

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

    private function buildCommand()
    {
        $command = 'php fruit ' . ($this->task)->task();
        if ($this->task->options() != null || empty($this->task->options()) === false) {
            $options = implode(' ', ($this->task)->options());
            $command = $command.' '.$options;
        }
        return $command;
    }

    private function setUpLock()
    {
        $store = new SemaphoreStore();
        $factory = new Factory($store);

        $this->lock = $factory->createLock($this->buildCommand());
    }

    private function checkLock()
    {

    }

}