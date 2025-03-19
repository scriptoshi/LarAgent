<?php

namespace LarAgent;

use LarAgent\Commands\AgentChatClearCommand;
use LarAgent\Commands\AgentChatCommand;
use LarAgent\Commands\AgentChatRemoveCommand;
use LarAgent\Commands\MakeAgentCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LarAgentServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laragent')
            ->hasConfigFile()
            ->hasCommands([
                MakeAgentCommand::class,
                AgentChatCommand::class,
                AgentChatClearCommand::class,
                AgentChatRemoveCommand::class,
            ]);
    }
}
