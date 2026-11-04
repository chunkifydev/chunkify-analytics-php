<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Omit;

/**
 * A playback event in log attributes. Duplicate attributes and invalid event fields reject the request.
 *
 * @phpstan-import-type OtlpAnyValueShape from \ChunkifyAnalytics\OtlpAnyValue
 *
 * @phpstan-type OtlpLogRecordShape = array{
 *   attributes: list<mixed>,
 *   body?: null|OtlpAnyValue|OtlpAnyValueShape,
 *   droppedAttributesCount?: int|null,
 *   eventName?: string|null,
 *   flags?: int|null,
 *   observedTimeUnixNano?: string|null,
 *   severityNumber?: int|null,
 *   severityText?: string|null,
 *   spanID?: string|null,
 *   timeUnixNano?: string|null,
 *   traceID?: string|null,
 * }
 */
final class OtlpLogRecord implements BaseModel
{
    /** @use SdkModel<OtlpLogRecordShape> */
    use SdkModel;

    /** @var list<mixed> $attributes */
    #[Required(list: OtlpAttribute::class)]
    public array $attributes;

    /**
     * Standard OTLP AnyValue in a preserved resource, scope or body. This collector does not decode these fields into the event.
     */
    #[Optional(nullable: true)]
    public ?OtlpAnyValue $body;

    #[Optional(nullable: true)]
    public ?int $droppedAttributesCount;

    #[Optional(nullable: true)]
    public ?string $eventName;

    #[Optional(nullable: true)]
    public ?int $flags;

    #[Optional(nullable: true)]
    public ?string $observedTimeUnixNano;

    #[Optional(nullable: true)]
    public ?int $severityNumber;

    #[Optional(nullable: true)]
    public ?string $severityText;

    #[Optional('spanId', nullable: true)]
    public ?string $spanID;

    #[Optional(nullable: true)]
    public ?string $timeUnixNano;

    #[Optional('traceId', nullable: true)]
    public ?string $traceID;

    /**
     * `new OtlpLogRecord()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OtlpLogRecord::with(attributes: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OtlpLogRecord)->withAttributes(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<mixed> $attributes
     * @param Omit|OtlpAnyValue|OtlpAnyValueShape|null $body
     */
    public static function with(
        array $attributes,
        Omit|OtlpAnyValue|array|null $body = Omit::Value,
        int|Omit|null $droppedAttributesCount = Omit::Value,
        string|Omit|null $eventName = Omit::Value,
        int|Omit|null $flags = Omit::Value,
        string|Omit|null $observedTimeUnixNano = Omit::Value,
        int|Omit|null $severityNumber = Omit::Value,
        string|Omit|null $severityText = Omit::Value,
        string|Omit|null $spanID = Omit::Value,
        string|Omit|null $timeUnixNano = Omit::Value,
        string|Omit|null $traceID = Omit::Value,
    ): self {
        $self = new self;

        $self['attributes'] = $attributes;

        Omit::Value !== $body && $self['body'] = $body;
        Omit::Value !== $droppedAttributesCount && $self['droppedAttributesCount'] = $droppedAttributesCount;
        Omit::Value !== $eventName && $self['eventName'] = $eventName;
        Omit::Value !== $flags && $self['flags'] = $flags;
        Omit::Value !== $observedTimeUnixNano && $self['observedTimeUnixNano'] = $observedTimeUnixNano;
        Omit::Value !== $severityNumber && $self['severityNumber'] = $severityNumber;
        Omit::Value !== $severityText && $self['severityText'] = $severityText;
        Omit::Value !== $spanID && $self['spanID'] = $spanID;
        Omit::Value !== $timeUnixNano && $self['timeUnixNano'] = $timeUnixNano;
        Omit::Value !== $traceID && $self['traceID'] = $traceID;

        return $self;
    }

    /**
     * @param list<mixed> $attributes
     */
    public function withAttributes(array $attributes): self
    {
        $self = clone $this;
        $self['attributes'] = $attributes;

        return $self;
    }

    /**
     * Standard OTLP AnyValue in a preserved resource, scope or body. This collector does not decode these fields into the event.
     *
     * @param OtlpAnyValue|OtlpAnyValueShape|null $body
     */
    public function withBody(OtlpAnyValue|array|null $body): self
    {
        $self = clone $this;
        $self['body'] = $body;

        return $self;
    }

    public function withDroppedAttributesCount(
        ?int $droppedAttributesCount
    ): self {
        $self = clone $this;
        $self['droppedAttributesCount'] = $droppedAttributesCount;

        return $self;
    }

    public function withEventName(?string $eventName): self
    {
        $self = clone $this;
        $self['eventName'] = $eventName;

        return $self;
    }

    public function withFlags(?int $flags): self
    {
        $self = clone $this;
        $self['flags'] = $flags;

        return $self;
    }

    public function withObservedTimeUnixNano(
        ?string $observedTimeUnixNano
    ): self {
        $self = clone $this;
        $self['observedTimeUnixNano'] = $observedTimeUnixNano;

        return $self;
    }

    public function withSeverityNumber(?int $severityNumber): self
    {
        $self = clone $this;
        $self['severityNumber'] = $severityNumber;

        return $self;
    }

    public function withSeverityText(?string $severityText): self
    {
        $self = clone $this;
        $self['severityText'] = $severityText;

        return $self;
    }

    public function withSpanID(?string $spanID): self
    {
        $self = clone $this;
        $self['spanID'] = $spanID;

        return $self;
    }

    public function withTimeUnixNano(?string $timeUnixNano): self
    {
        $self = clone $this;
        $self['timeUnixNano'] = $timeUnixNano;

        return $self;
    }

    public function withTraceID(?string $traceID): self
    {
        $self = clone $this;
        $self['traceID'] = $traceID;

        return $self;
    }
}
