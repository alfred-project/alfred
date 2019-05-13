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

namespace Alfred\Alfred\Infrastructure\UI\Console\Command;

use Symfony\Component\Console\Command\Command;

/**
 * Comando para crear nuevos proyectos a partir de una template
 */
class CreateProject extends Command
{
    /**
     * CreateProject constructor.
     */
    public function __construct()
    {
        parent::__construct('create-project');
    }

    /**
     * Configura el comando
     */
    public function configure(): void
    {
        $this
            ->setDescription('Creates a new project.')
            ->setHelp('This command allows you to create a new project from a template');
    }
}
