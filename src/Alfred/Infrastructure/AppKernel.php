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

namespace Alfred\Alfred\Infrastructure;

use Alfred\Alfred\Infrastructure\DependencyInjection\CommandCompilerPass;
use Alfred\Alfred\Infrastructure\UI\Console\Application;
use Alfred\Alfred\Infrastructure\UI\Console\Command\CreateProjectCommand;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Kernel de la aplicación
 */
final class AppKernel extends Kernel
{

    /**
     * @inheritdoc
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder
     */
    protected function build(ContainerBuilder $containerBuilder): void
    {
        $containerBuilder->addCompilerPass(new CommandCompilerPass());
    }

    /**
     * @inheritdoc
     *
     * @return iterable|\Symfony\Component\HttpKernel\Bundle\BundleInterface[] An iterable of bundle instances
     */
    public function registerBundles(): iterable
    {
        $contents = require $this->getProjectDir().'/config/bundles.php';

        foreach ($contents as $class => $envs) {
            if ($envs[$this->environment] ?? $envs['all'] ?? false) {
                yield new $class();
            }
        }
    }

    /**
     * @inheritdoc
     *
     * @param \Symfony\Component\Config\Loader\LoaderInterface $loader
     *
     * @throws \Exception
     */
    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $projectPath = realpath(__DIR__.'/../../..');

        $loader->load($projectPath.'/config/services.yaml');
    }

    /**
     * Devuelve la aplicación de consola
     *
     * @return \Alfred\Alfred\Infrastructure\UI\Console\Application
     */
    public function getConsoleApplication(): Application
    {
        $this->getContainer()->get(CreateProjectCommand::class);

        return $this->getContainer()->get(Application::class);
    }
}
