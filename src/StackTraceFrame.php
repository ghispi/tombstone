<?php

namespace Scheb\Tombstone;

class StackTraceFrame
{
    /**
     * @var string|null
     */
    private $file;

    /**
     * @var int|null
     */
    private $line;

    /**
     * @var string|null
     */
    private $method;

    public function __construct(?string $file, ?int $line, ?string $method)
    {
        $this->file = $file;
        $this->line = $line;
        $this->method = $method;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function getLine(): ?int
    {
        return $this->line;
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }
}