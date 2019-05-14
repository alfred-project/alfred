#!/usr/bin/env php
<?php

use Alfred\Alfred\Infrastructure\AppKernel;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Debug\Debug;

if (false === in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true)) {
    echo 'Warning: The console should be invoked via the CLI version of PHP, not the ' . \PHP_SAPI . ' SAPI' . \PHP_EOL;
}

set_time_limit(0);

require dirname(__DIR__) . '/vendor/autoload.php';

$input = new ArgvInput();
if (null !== $env = $input->getParameterOption(['--env', '-e'], null, true)) {
    putenv('APP_ENV=' . $_SERVER['APP_ENV'] = $_ENV['APP_ENV'] = $env);
}

require dirname(__DIR__) . '/config/bootstrap.php';

if ($_SERVER['APP_DEBUG']) {
    umask(0000);

    if (class_exists(Debug::class)) {
        Debug::enable();
    }
}

$kernel = new AppKernel($_SERVER['APP_ENV'], $_SERVER['APP_DEBUG']);
$kernel->boot();

$application = $kernel->getConsoleApplication();
$application->run($input);

