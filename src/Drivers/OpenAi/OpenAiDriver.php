<?php

namespace LarAgent\Drivers\OpenAi;

use LarAgent\Core\Abstractions\LlmDriver;
use LarAgent\Core\Contracts\LlmDriver as LlmDriverInterface;
use LarAgent\Core\Contracts\ToolCall as ToolCallInterface;
use LarAgent\Messages\AssistantMessage;
use LarAgent\Messages\StreamedAssistantMessage;
use LarAgent\Messages\ToolCallMessage;
use LarAgent\ToolCall;
use OpenAI;

class OpenAiDriver extends BaseOpenAiDriver
{
    protected mixed $client;

    public function __construct(array $provider = [])
    {
        parent::__construct($provider);
        $this->client = $provider['api_key'] ? OpenAI::client($provider['api_key']) : null;
    }
}