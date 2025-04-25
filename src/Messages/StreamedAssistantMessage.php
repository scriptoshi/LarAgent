<?php

namespace LarAgent\Messages;

use LarAgent\Core\Abstractions\Message;
use LarAgent\Core\Contracts\Message as MessageInterface;
use LarAgent\Core\Enums\Role;

class StreamedAssistantMessage extends AssistantMessage implements MessageInterface
{
    protected bool $isComplete = false;
    
    protected ?array $usage = null;

    protected ?string $lastChunk = null;

    public function __construct(string $content = '', array $metadata = [])
    {
        parent::__construct($content, $metadata);
    }

    /**
     * Append content to the existing message content
     *
     * @param string $chunk Content chunk to append
     * @return self
     */
    public function appendContent(string $chunk): self
    {
        $this->content .= $chunk;
        $this->lastChunk = $chunk;
        return $this;
    }

    /**
     * Mark the message as complete
     *
     * @param bool $isComplete
     * @return self
     */
    public function setComplete(bool $isComplete = true): self
    {
        $this->isComplete = $isComplete;
        return $this;
    }

    /**
     * Check if the message is complete
     *
     * @return bool
     */
    public function isComplete(): bool
    {
        return $this->isComplete;
    }

    /**
     * Set usage information (available only when stream is complete)
     *
     * @param array|null $usage
     * @return self
     */
    public function setUsage(?array $usage): self
    {
        $this->usage = $usage;
        return $this;
    }

    /**
     * Get usage information
     *
     * @return array|null
     */
    public function getUsage(): ?array
    {
        return $this->usage;
    }

    public function getLastChunk(): ?string
    {
        return $this->lastChunk;
    }
}
