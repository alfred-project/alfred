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

use League\Tactician\CommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Comando para crear nuevos proyectos a partir de una template
 */
class CreateProject extends Command
{
    /**
     * @var \League\Tactician\CommandBus
     */
    private $commandBus;

    /**
     * CreateProject constructor.
     *
     * @param \League\Tactician\CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        parent::__construct('create-project');
        $this->commandBus = $commandBus;
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


    /**
     * @inheritdoc
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = new \Alfred\Alfred\Application\UseCase\CreateProject();

        return $this->commandBus->handle($command);
    }
}
