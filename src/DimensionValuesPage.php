<?php

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Concerns\SdkPage;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Contracts\BasePage;
use ChunkifyAnalytics\Core\Conversion;
use ChunkifyAnalytics\Core\Conversion\Contracts\Converter;
use ChunkifyAnalytics\Core\Conversion\Contracts\ConverterSource;
use ChunkifyAnalytics\Core\Conversion\ListOf;
use Psr\Http\Message\ResponseInterface;

/**
 * @phpstan-type DimensionValuesPageShape = array{
 *   values?: list<mixed>|null, nextCursor?: string|null
 * }
 *
 * @template TItem
 *
 * @implements BasePage<TItem>
 */
final class DimensionValuesPage implements BaseModel, BasePage
{
    /** @use SdkModel<DimensionValuesPageShape> */
    use SdkModel;

    /** @use SdkPage<TItem> */
    use SdkPage;

    /** @var list<TItem>|null $values */
    #[Optional(list: 'mixed')]
    public ?array $values;

    #[Optional('next_cursor', nullable: true)]
    public ?string $nextCursor;

    /**
     * @internal
     *
     * @param array{
     *   method: string,
     *   path: string,
     *   query: array<string,mixed>,
     *   headers: array<string,string|list<string>|null>,
     *   body: mixed,
     * } $requestInfo
     */
    public function __construct(
        private string|Converter|ConverterSource $convert,
        private Client $client,
        private array $requestInfo,
        private RequestOptions $options,
        private ResponseInterface $response,
        private mixed $parsedBody,
    ) {
        $this->initialize();

        if (!is_array($this->parsedBody)) {
            return;
        }

        $properties = Conversion::coerce(self::class, value: $this->parsedBody);
        self::__unserialize(
            // @phpstan-ignore-next-line argument.type
            $properties instanceof self ? $properties->toProperties() : $this->parsedBody,
        );

        if (is_array($items = $this->offsetGet('values'))) {
            $parsed = Conversion::coerce(new ListOf($convert), value: $items);
            // @phpstan-ignore-next-line
            $this->offsetSet('values', value: $parsed);
        }
    }

    /** @return list<TItem> */
    public function getItems(): array
    {
        // @phpstan-ignore-next-line return.type
        return $this->offsetGet('values') ?? [];
    }

    /**
     * @internal
     *
     * @return array{
     *   array{
     *     method: string,
     *     path: string,
     *     query: array<string,mixed>,
     *     headers: array<string,string|list<string>|null>,
     *     body: mixed,
     *   },
     *   RequestOptions,
     * }|null
     */
    public function nextRequest(): ?array
    {
        if (!count($this->getItems())) {
            return null;
        }

        if (!($next = $this->nextCursor ?? null)) {
            return null;
        }

        $nextRequest = array_replace_recursive(
            $this->requestInfo,
            ['query' => ['cursor' => $next]]
        );

        // @phpstan-ignore-next-line return.type
        return [$nextRequest, $this->options];
    }
}
