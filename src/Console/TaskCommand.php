<?php
/**
 * Created by PhpStorm.
 * User: afriedrich
 * Date: 05.06.18
 * Time: 15:51
 */

namespace KiwiSuite\Scheduler\Console;


use KiwiSuite\Contract\Command\CommandInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TaskCommand extends Command implements CommandInterface
{
    public function __construct()
    {
        parent::__construct(self::getCommandName());
    }

    protected function configure()
    {
        $this->addArgument('name',InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $task = $input->getArgument('name');

    }

    public static function getCommandName()
    {
        return 'task:run';
    }
}