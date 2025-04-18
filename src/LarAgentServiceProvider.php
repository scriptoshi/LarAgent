<?php

namespace LarAgent;

use LarAgent\Commands\AgentChatClearCommand;
use LarAgent\Commands\AgentChatCommand;
use LarAgent\Commands\AgentChatRemoveCommand;
use LarAgent\Commands\MakeAgentCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use LarAgent\Core\Contracts\LlmDriver;
use LarAgent\Drivers\OpenAi\OpenAiDriver;
use LarAgent\Core\Contracts\ChatHistory;
use LarAgent\History\InMemoryChatHistory;
use Illuminate\Support\Str;

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

    public function register()
    {
        parent::register();

        $this->app->singleton(LlmDriver::class, function ($app) {
            $config = $app['config']->get('laragent.providers.default');
            return new OpenAiCompatible($config);
        });

        $this->app->bind(ChatHistory::class, function ($app) {
            $name = Str::random(10);
            return new InMemoryChatHistory($name, []);
        });
    }
}
