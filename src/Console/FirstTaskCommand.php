<?php
/**
 * Created by PhpStorm.
 * User: afriedrich
 * Date: 01.06.18
 * Time: 09:45
 */

namespace KiwiSuite\Scheduler\Console;


use KiwiSuite\Contract\Command\CommandInterface;
use KiwiSuite\Scheduler\SchedulerMonitor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FirstTaskCommand extends Command implements CommandInterface
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
        chdir(getcwd() . '/scheduler/');
        $file = fopen('task1.txt', "a");
        $txt = 'Event1' . ' ' . \date("h:i:sa") . PHP_EOL;
        fwrite($file,$txt);
        fclose($file);
    }

    public static function getCommandName()
    {
        return "task:task-1";
    }
}