<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Scheduler\Package\Console;

use Ixocreate\Application\Console\CommandInterface;;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class GenerateCallTask extends Command implements CommandInterface
{
    private $template = <<< 'EOD'
<?php
declare(strict_types=1);

namespace App\Scheduler\Task;

use Ixocreate\Scheduler\Package\Expression\SchedulerExpression;
use Ixocreate\Scheduler\Package\Task\CallTaskInterface;
use Ixocreate\Scheduler\Package\Task\TaskInterface;

final class %s implements TaskInterface, CallTaskInterface
{

    public function task()
    {

    }

    /**
     * @return string
     */
    public static function serviceName(): string
    {
        return '%s';
    }

    /**
     * @param SchedulerExpression $expression
     * @return string
     */
    public function schedule(SchedulerExpression $expression)
    {
        return $expression->cron();
    }

    /**
     * @return bool
     */
    public function lock(): bool
    {
        return true;
    }
}
EOD;

    /**
     * GenerateCallTask constructor.
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
        return 'scheduler:generate-callTask';
    }

    protected function configure()
    {
        $this
            ->setDescription('Generates a new CallTask')
            ->setHelp('This command allows you to generate a new CallTask')
            ->addArgument('name', InputArgument::REQUIRED, 'Name of the Task');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws \Exception
     * @return int|null|void
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
            \sprintf(
                $this->template,
                \trim(\ucfirst($input->getArgument('name'))),
                \trim(\ucfirst($input->getArgument('name')))
            )
        );
    }
}
