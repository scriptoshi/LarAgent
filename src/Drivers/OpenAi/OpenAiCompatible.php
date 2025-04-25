<?php

namespace LarAgent\Drivers\OpenAi;

use LarAgent\Core\Abstractions\LlmDriver;
use LarAgent\Core\Contracts\LlmDriver as LlmDriverInterface;
use LarAgent\Core\Contracts\ToolCall as ToolCallInterface;
use LarAgent\Messages\AssistantMessage;
use LarAgent\Messages\ToolCallMessage;
use LarAgent\Messages\StreamedAssistantMessage;
use LarAgent\ToolCall;
use OpenAI;

class OpenAiCompatible extends BaseOpenAiDriver
{
    protected string $default_url = 'https://api.openai.com/v1';

    public function __construct(array $provider = [])
    {
        parent::__construct($provider);
        if ($provider['api_key']) {
            $this->client = $this->buildClient($provider['api_key'], $provider['api_url'] ?? $this->default_url);
        } else {
            throw new \Exception('OpenAiCompatible driver requires api_key in provider settings.');
        }
    }

    protected function buildClient(string $apiKey, string $baseUrl): mixed
    {
        $client = OpenAI::factory()
            ->withApiKey($apiKey)
            ->withBaseUri($baseUrl)
            ->withHttpClient($httpClient = new \GuzzleHttp\Client([]))
            ->make();

        return $client;
    }
}
