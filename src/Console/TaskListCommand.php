<?php
declare(strict_types=1);

namespace KiwiSuite\Scheduler\Console;


use KiwiSuite\Contract\Command\CommandInterface;
use KiwiSuite\Scheduler\Task\TaskSubManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class TaskListCommand extends Command implements CommandInterface
{
    /**
     * @var TaskSubManager
     */
    private $taskSubManager;

    /**
     * TaskListCommand constructor.
     * @param TaskSubManager $taskSubManager
     */
    public function __construct(TaskSubManager $taskSubManager)
    {
        parent::__construct(self::getCommandName());
    }

    protected function configure()
    {
        $this->setDescription('A List of all registered Tasks');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $data = [];
        foreach (array_keys($this->taskSubManager->getServiceManagerConfig()->getNamedServices()) as $name) {
            $data[] = [
                $name,
            ];
        }

        $io->table(
            ['Task'],
            $data
        );
    }

    /**
     * @return string
     */
    public static function getCommandName()
    {
        return 'scheduler:list-tasks';
    }
}