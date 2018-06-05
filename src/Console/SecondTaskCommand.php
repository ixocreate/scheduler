<?php
/**
 * Created by PhpStorm.
 * User: afriedrich
 * Date: 05.06.18
 * Time: 09:30
 */

namespace KiwiSuite\Scheduler\Console;


use KiwiSuite\Contract\Command\CommandInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class SecondTaskCommand extends Command implements CommandInterface
{
    public function __construct()
    {
        parent::__construct(self::getCommandName());
    }

    protected function configure()
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $process = new Process('php fruit task:task-1');
        $process->run();
    }

    public static function getCommandName()
    {
        return "task:task-2";
    }
}