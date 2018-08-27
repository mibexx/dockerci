<?php
declare(strict_types=1);

namespace App\Console;


use Xervice\Console\ConsoleDependencyProvider as XerviceConsoleDependencyProvider;
use Xervice\Database\Communication\Console\Command\ConfigGenerateCommand;
use Xervice\Database\Communication\Console\Command\MigrateCommand;
use Xervice\Database\Communication\Console\Command\ModelBuildCommand;
use Xervice\DataProvider\Communication\Console\CleanCommand;
use Xervice\DataProvider\Communication\Console\GenerateCommand;
use Xervice\Development\Communication\Console\Command\GenerateAutoCompleteCommand;
use Xervice\RabbitMQ\Communication\Console\Command\WorkerCommand;

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