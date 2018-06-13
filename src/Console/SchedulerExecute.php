<?php

namespace KiwiSuite\Scheduler\Console;


use Cocur\BackgroundProcess\BackgroundProcess;
use KiwiSuite\Contract\Command\CommandInterface;
use KiwiSuite\Scheduler\Task\CallTaskInterface;
use KiwiSuite\Scheduler\Task\CommandTaskInterface;
use KiwiSuite\Scheduler\Task\TaskMapping;
use KiwiSuite\Scheduler\Task\TaskSubManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Lock\Factory;
use Symfony\Component\Lock\Store\SemaphoreStore;


final class SchedulerExecute extends Command implements CommandInterface
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
     * @var mixed
     */
    private $task;

    /**
     * @var BackgroundProcess
     */
    private $process;

    public function __construct(TaskMapping $taskMapping, TaskSubManager $taskSubManager)
    {
        $this->taskMapping = $taskMapping;
        $this->taskSubManager = $taskSubManager;

        parent::__construct(self::getCommandName());
    }

    public static function getCommandName()
    {
        return 'scheduler:exec';
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
        $build = null;
        if ($this->task instanceof CallTaskInterface) {
            $build = $this->buildCall();
        }
        if ($this->task instanceof CommandTaskInterface) {
            $build = $this->buildCommand();
        }

        $this->process = new BackgroundProcess($build);

        if ($this->task->lock()) {
            $this->setUpLock($build);
        }
        if (!$this->task->lock()) {
            $this->process->run();
        }
    }

    private function buildCommand()
    {
        $command = 'php fruit ' . $this->task->run();
        return $command;
    }

    private function buildCall()
    {
        $call = 'php fruit scheduler:exec-call '.$this->task->getName();
        return $call;
    }

    private function setUpTask(string $taskName)
    {
        $tasks = [];
        $namespace = [];
        foreach ($this->taskMapping->getMapping() as $task) {
            $namespace[$task] = $tasks[] = ($this->taskSubManager->get($task))->getName();
        }
        $key = array_search($taskName, $namespace);
        return $this->taskSubManager->get($key);
    }

    private function setUpLock($build)
    {
        $store = new SemaphoreStore();
        $factory = new Factory($store);
        $lock = $factory->createLock($build);

        if ($lock->acquire()) {
            $this->process->run();
            try {
                while ($this->process->isRunning()) {
                    $lock->refresh();
                }
            } finally {
                $lock->release();
            }
        }
    }
}