<?php
declare(strict_types=1);

namespace App\Console;


use Xervice\Console\ConsoleDependencyProvider as XerviceConsoleDependencyProvider;
use Xervice\Database\Command\ConfigGenerateCommand;
use Xervice\Database\Command\MigrateCommand;
use Xervice\Database\Command\ModelBuildCommand;
use Xervice\DataProvider\Console\CleanCommand;
use Xervice\DataProvider\Console\GenerateCommand;
use Xervice\Development\Command\GenerateAutoCompleteCommand;
use Xervice\RabbitMQ\Worker\Command\WorkerCommand;

class ConsoleDependencyProvider extends XerviceConsoleDependencyProvider
{
    /**
     * @return array
     */
    protected function getCommandList(): array
    {
        return array_merge(
            [
                new GenerateCommand(),
                new CleanCommand(),
                new WorkerCommand(),
                new ModelBuildCommand(),
                new MigrateCommand(),
                new ConfigGenerateCommand()
            ],
            $this->getDevCommands()
        );
    }

    protected function getDevCommands()
    {
        $commands = [];

        if (class_exists(GenerateAutoCompleteCommand::class)) {
            $commands[] = new GenerateAutoCompleteCommand();
        }

        return $commands;
    }
}