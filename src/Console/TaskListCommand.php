<?php
declare(strict_types=1);

namespace KiwiSuite\Scheduler\Console;


use KiwiSuite\Contract\Command\CommandInterface;
use KiwiSuite\Scheduler\Task\TaskMapping;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class TaskListCommand extends Command implements CommandInterface
{
    /**
     * @var TaskMapping
     */
    private $taskMapping;

    /**
     * TaskListCommand constructor.
     * @param TaskMapping $taskMapping
     */
    public function __construct(TaskMapping $taskMapping)
    {
        $this->taskMapping = $taskMapping;
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
        foreach ($this->taskMapping->getMapping() as $name => $namespace) {
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