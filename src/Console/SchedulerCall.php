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

namespace KiwiSuite\Scheduler\Console;


use KiwiSuite\Contract\Command\CommandInterface;
use Symfony\Component\Console\Command\Command;
use KiwiSuite\Scheduler\Task\TaskSubManager;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

final class SchedulerCall extends Command implements CommandInterface
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
     * SchedulerCall constructor.
     * @param TaskMapping $taskMapping
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
        return 'scheduler:exec-call';
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
        $this->task->task();
    }
}