<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Scheduler\Console;

use Cocur\BackgroundProcess\BackgroundProcess;
use Ixocreate\Contract\Command\CommandInterface;
use Ixocreate\Scheduler\Task\CallTaskInterface;
use Ixocreate\Scheduler\Task\CommandTaskInterface;
use Ixocreate\Scheduler\Task\TaskSubManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Lock\Factory;
use Symfony\Component\Lock\Store\SemaphoreStore;

final class SchedulerExecute extends Command implements CommandInterface
{
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

    /**
     * SchedulerExecute constructor.
     * @param TaskSubManager $taskSubManager
     */
    public function __construct(TaskSubManager $taskSubManager)
    {
        $this->taskSubManager = $taskSubManager;
        parent::__construct(self::getCommandName());
    }

    /**
     * @return string
     */
    public static function getCommandName()
    {
        return 'scheduler:exec';
    }

    /**
     * Command Configuration
     */
    protected function configure()
    {
        $this
            ->setHidden(true)
            ->addArgument('name', InputArgument::REQUIRED);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->task = $this->taskSubManager->get($input->getArgument('name'));
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
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

    /**
     * @return string
     */
    private function buildCommand()
    {
        $command = 'php ixocreate ' . $this->task->run();
        return $command;
    }

    /**
     * @return string
     */
    private function buildCall()
    {
        $call = 'php ixocreate scheduler:exec-call ' . $this->task->serviceName();
        return $call;
    }

    /**
     * @param $build
     */
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
