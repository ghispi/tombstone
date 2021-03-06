<?php

declare(strict_types=1);

namespace Scheb\Tombstone\Formatter;

use Scheb\Tombstone\StackTraceFrame;
use Scheb\Tombstone\Vampire;

class JsonFormatter implements FormatterInterface
{
    public function format(Vampire $vampire): string
    {
        return json_encode([
            'arguments' => $vampire->getArguments(),
            'file' => $vampire->getFile(),
            'line' => $vampire->getLine(),
            'method' => $vampire->getMethod(),
            'stackTrace' => $this->getStackTraceValues($vampire->getStackTrace()),
            'metadata' => $vampire->getMetadata(),
            'invocationDate' => $vampire->getInvocationDate(),
            'invoker' => $vampire->getInvoker(),
        ])."\n";
    }

    private function getStackTraceValues(array $stackTrace): array
    {
        return array_map(function (StackTraceFrame $frame): array {
            return [
                'file' => $frame->getFile(),
                'line' => $frame->getLine(),
                'method' => $frame->getMethod(),
            ];
        }, $stackTrace);
    }
}
