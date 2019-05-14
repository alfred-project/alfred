<?php

/**
 * This file is part of the planb project.
 *
 * (c) jmpantoja <jmpantoja@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Alfred\Alfred\Infrastructure\UI\Console;

use Symfony\Component\Console\Application as ApplicationConsole;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Application para la consola
 */
class Application extends ApplicationConsole
{

    /**
     * @inheritDoc
     */
    protected function getDefaultInputDefinition()
    {
        $definition = parent::getDefaultInputDefinition();

        $definition->addOption(new InputOption('env', 'e', InputOption::VALUE_OPTIONAL, 'el entorno de ejecución'));

        return $definition;
    }

    /**
     * Este método modifica el render de las excepciones
     * Renders a caught exception.
     *
     * @param \Exception $exception
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    public function renderException(\Exception $exception, OutputInterface $output): void
    {
        parent::renderException($exception, $output);
    }
}
