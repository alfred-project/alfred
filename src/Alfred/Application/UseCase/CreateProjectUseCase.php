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

namespace Alfred\Alfred\Application\UseCase;

/**
 * Caso de uso "crear proyecto"
 */
class CreateProjectUseCase
{
    /**
     * Ejecuta el comando
     *
     * @param \Alfred\Alfred\Application\UseCase\CreateProject $command
     */
    public function handle(CreateProject $command): void
    {
        dump(__METHOD__.': '.get_class($command));
    }
}
