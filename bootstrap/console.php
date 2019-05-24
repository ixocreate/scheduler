<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Scheduler;

use Ixocreate\Application\Console\ConsoleConfigurator;

/** @var ConsoleConfigurator $console */
$console->addDirectory(__DIR__ . '/../src/Console', true);
