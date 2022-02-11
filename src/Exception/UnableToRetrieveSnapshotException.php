<?php

declare(strict_types=1);

namespace Andreo\EventSauce\Snapshotting\Exception;

use EventSauce\EventSourcing\EventSauceException;
use RuntimeException;
use Throwable;

class UnableToRetrieveSnapshotException extends RuntimeException implements EventSauceException
{
    public static function dueTo(string $reason = '', Throwable $previous = null): self
    {
        return new self("Unable to retrieve messages. {$reason}", 0, $previous);
    }
}
