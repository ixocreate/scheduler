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

namespace KiwiSuite\Scheduler\Expression;



final class SchedulerExpression
{

    public function cron(string $custom = '* * * * *')
    {
        return $custom;
    }

    /**
     * @return string
     */
    public function everyMinute()
    {
        return '* * * * *';
    }

    /**
     * @return string
     */
    public function everyFiveMinutes()
    {
        return '*/5 * * * *';
    }

    /**
     * @return string
     */
    public function everyTenMinutes()
    {
        return '*/10 * * * *';
    }

    /**
     * @return string
     */
    public function everyFifteenMinutes()
    {
        return '*/15 * * * *';
    }

    /**
     * @return string
     */
    public function everyThirtyMinutes()
    {
        return '*/30 * * * *';
    }

    /**
     * @return string
     */
    public function hourly()
    {
        return '0 * * * *';
    }

    /**
     * @return string
     */
    public function daily()
    {
        return '0 0 * * *';
    }

    /**
     * @param string $time
     * @return string
     */
    public function dailyAt(string $time = '00:00')
    {
        $explode = \explode(':', $time);
        $hours = $explode[0];
        $minutes = $explode[1];

        return "$minutes $hours * * *";
    }

    /**
     * @return string
     */
    public function weekly()
    {
        return '0 0 * * 0';
    }

    /**
     * Runs every week on given day and time, where "day = 1" is monday and "day = 7" is sunday.
     * @param int $day
     * @param string $time
     * @return string
     */
    public function weeklyOn(int $day = 1, string $time = '00:00')
    {
        if ($day > 7) {
            $day = 7;
        }
        if ($day < 1) {
            $day = 1;
        }
        $explode = \explode(':', $time);
        $hours = $explode[0];
        $minutes = $explode[1];

        return "$minutes $hours * * $day";
    }

    /**
     * @return string
     */
    public function monthly()
    {
        return '0 0 1 * *';
    }

    /**
     * @param int $day
     * @param string $time
     * @return string
     */
    public function monthlyOn(int $day = 1, string $time = '00:00')
    {
        if ($day > 31) {
            $day = 31;
        }
        if ($day < 1) {
            $day = 1;
        }
        $explode = \explode(':', $time);
        $hours = $explode[0];
        $minutes = $explode[1];

        return "$minutes $hours $day * *";
    }

    /**
     * @return string
     */
    public function yearly()
    {
        return '0 0 1 1 *';
    }
}