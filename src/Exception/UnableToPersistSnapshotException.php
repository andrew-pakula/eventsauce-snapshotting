<?php

declare(strict_types=1);

namespace Andreo\EventSauce\Snapshotting\Exception;

use EventSauce\EventSourcing\EventSauceException;
use RuntimeException;
use Throwable;

final class UnableToPersistSnapshotException extends RuntimeException implements EventSauceException
{
    public static function dueTo(string $reason = '', Throwable $previous = null): self
    {
        return new self("Unable to persist snapshot. {$reason}", 0, $previous);
    }
}
