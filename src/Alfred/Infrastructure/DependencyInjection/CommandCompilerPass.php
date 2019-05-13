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

namespace Alfred\Alfred\Infrastructure\DependencyInjection;

use Alfred\Alfred\Infrastructure\UI\Console\Application;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * CompilerPass para registar comandos
 */
final class CommandCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritdoc
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function process(ContainerBuilder $container): void
    {
        $application = $container->getDefinition(Application::class);

        $taggedServices = $container->findTaggedServiceIds('alfred.command');

        $commands = array_keys($taggedServices);

        foreach ($commands as $command) {
            $application->addMethodCall('add', [new Reference($command)]);
        }
    }
}
