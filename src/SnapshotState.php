<?php

declare(strict_types=1);


namespace Andreo\EventSauce\Snapshotting;

use DateTimeImmutable;

final class SnapshotState
{
    private const CREATED_AT_FORMAT = 'Y-m-d H:i:s.uO';

    private function __construct(
        public readonly object $state,
        public array $headers = []
    ){}

    public function withCreatedAt(DateTimeImmutable $createdAt): self
    {
        return $this->withHeader(Header::CREATED_AT, $createdAt->format(self::CREATED_AT_FORMAT));
    }

    public function withStateType(string $type): self
    {
        return $this->withHeader(Header::STATE_TYPE, $type);
    }

    public function withHeader(Header $key, int|string|array|bool|float $value): self
    {
        $clone = clone $this;
        $clone->headers[$key->value] = $value;

        return $clone;
    }

    public function schemaVersion(): int
    {
        return $this->headers[Header::SCHEMA_VERSION->value];
    }

    public function exists(string $header): bool
    {
        return null !== $this->header($header);
    }

    public function header(string $key): int|string|array|bool|float|null
    {
        return $this->headers[$key] ?? null;
    }

    public static function from(object $state, array $headers = []): self
    {
        return new self($state, $headers);
    }
}