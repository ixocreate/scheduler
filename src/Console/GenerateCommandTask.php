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
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

final class GenerateCommandTask extends Command implements CommandInterface
{
    private $template = <<< 'EOD'
<?php
declare(strict_types=1);

namespace App\Scheduler\Task;


use KiwiSuite\Scheduler\Expression\SchedulerExpression;
use KiwiSuite\Scheduler\Task\CommandTaskInterface;
use KiwiSuite\Scheduler\Task\TaskInterface;

final class %s implements TaskInterface, CommandTaskInterface
{

    public function run(): string
    {
    
    }

    public static function getName(): string
    {
        return '%s';
    }

    public function schedule(SchedulerExpression $expression)
    {
        return $expression->cron();
    }

    public function lock(): bool
    {
        return true;
    }
}
EOD;

    /**
     * GenerateCommandTask constructor.
     */
    public function __construct()
    {
        parent::__construct(self::getCommandName());
    }

    /**
     * @return string
     */
    public static function getCommandName()
    {
        return 'scheduler:generate-commandTask';
    }

    protected function configure()
    {
        $this
            ->setDescription('Generates a new CommandTask')
            ->setHelp('This command allows you to generate a new CommandTask')
            ->addArgument('name', InputArgument::REQUIRED, 'Name of the Task');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!\is_dir(\getcwd() . '/src/App/Scheduler/Task')) {
            \mkdir(\getcwd() . '/src/App/Scheduler/Task', 0777, true);
        }
        if (\file_exists(\getcwd() .
            '/src/App/Scheduler/Task/' .
            \trim(\ucfirst($input->getArgument('name'))) . '.php')) {
            throw new \Exception("Task file already exists");
        }
        $this->generateFile($input);
        $output->writeln(
            \sprintf("<info>Task '%s' generated</info>", \trim(\ucfirst($input->getArgument('name'))))
        );
    }

    /**
     * @param InputInterface $input
     */
    private function generateFile(InputInterface $input): void
    {
        \file_put_contents(
            \getcwd() . '/src/App/Scheduler/Task/' . \trim(\ucfirst($input->getArgument('name'))) . '.php',
            \sprintf($this->template,
                \trim(\ucfirst($input->getArgument('name'))),
                \trim(\ucfirst($input->getArgument('name')))
            )
        );
    }
}