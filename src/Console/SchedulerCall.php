<?php
/**
 * Created by PhpStorm.
 * User: afriedrich
 * Date: 12.06.18
 * Time: 16:00
 */

namespace KiwiSuite\Scheduler\Console;


use KiwiSuite\Contract\Command\CommandInterface;
use Symfony\Component\Console\Command\Command;
use KiwiSuite\Scheduler\Task\TaskMapping;
use KiwiSuite\Scheduler\Task\TaskSubManager;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

final class SchedulerCall extends Command implements CommandInterface
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

    public function __construct(TaskMapping $taskMapping, TaskSubManager $taskSubManager)
    {
        $this->taskMapping = $taskMapping;
        $this->taskSubManager = $taskSubManager;

        parent::__construct(self::getCommandName());
    }

    public static function getCommandName()
    {
        return 'scheduler:exec-call';
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
        $this->task->task();
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

}