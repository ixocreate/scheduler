<?php
/** @var \KiwiSuite\ApplicationHttp\Middleware\MiddlewareConfigurator $middleware */

use KiwiSuite\Scheduler\Middleware\SchedulerMiddleware;

$middleware->addAction(SchedulerMiddleware::class);