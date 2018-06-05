<?php
declare(strict_types=1);

namespace KiwiSuite\Scheduler;



class Scheduler
{
    public function everyMinute()
    {
        return '* * * * *';
    }


}