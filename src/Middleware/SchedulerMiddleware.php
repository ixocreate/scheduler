<?php
declare(strict_types=1);

namespace KiwiSuite\Scheduler\Middleware;


use KiwiSuite\Admin\Response\ApiSuccessResponse;
use KiwiSuite\ApplicationConsole\ConsoleSubManager;
use KiwiSuite\Scheduler\Task\TaskMapping;
use KiwiSuite\Scheduler\Task\TaskSubManager;
use KiwiSuite\Scheduler\Task\TestTask;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SchedulerMiddleware implements MiddlewareInterface
{
    private $subManager;

    private $taskMapping;

    public function __construct(TaskSubManager $subManager, TaskMapping $taskMapping, ConsoleSubManager $consoleSubManager)
    {
        $this->subManager = $subManager;
        $this->taskMapping = $taskMapping;

    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        $task = $this->subManager->get(TestTask::class);
        $task->task();

        return new ApiSuccessResponse();
    }
}