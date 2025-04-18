<?php

// config for Maestroerror/LarAgent
return [
    'default_driver' => \LarAgent\Drivers\OpenAi\OpenAiDriver::class,
    'default_chat_history' => \LarAgent\History\InMemoryChatHistory::class,

    'providers' => [

        // Always keep at least one provider named 'default'
        'default' => [
            'name' => 'openai',
            'api_key' => env('OPENAI_API_KEY'),
            'default_context_window' => 50000,
            'default_max_completion_tokens' => 10000,
            'default_temperature' => 1,
        ],
    ],
];
