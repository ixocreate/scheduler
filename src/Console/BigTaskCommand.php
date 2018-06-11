<?php
/**
 * Created by PhpStorm.
 * User: afriedrich
 * Date: 06.06.18
 * Time: 09:09
 */

namespace KiwiSuite\Scheduler\Console;


use KiwiSuite\Contract\Command\CommandInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BigTaskCommand extends Command implements CommandInterface
{

    public function __construct()
    {
        parent::__construct(self::getCommandName());
    }

    public static function getCommandName()
    {
        return 'task:task-big';
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        chdir(getcwd() . '/scheduler/');
        $file = fopen('task-big.txt', 'a');

        for ($i = 0; $i <= 15; $i++) {
            fwrite($file, $i . ' --- ' . \date("h:i:sa") . PHP_EOL);
            sleep(1);
        }
        fclose($file);
    }


}