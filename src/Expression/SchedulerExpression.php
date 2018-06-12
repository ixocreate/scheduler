<?php
declare(strict_types=1);

namespace KiwiSuite\Scheduler\Expression;



final class SchedulerExpression
{
    public function everyMinute()
    {
        return '* * * * *';
    }

    public function every2Minutes()
    {
        return '*/2 * * * *';
    }


}