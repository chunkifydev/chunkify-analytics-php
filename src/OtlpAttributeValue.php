<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\Concerns\SdkUnion;
use ChunkifyAnalytics\Core\Conversion\Contracts\Converter;
use ChunkifyAnalytics\Core\Conversion\Contracts\ConverterSource;
use ChunkifyAnalytics\OtlpAttributeValue\UnionMember0;
use ChunkifyAnalytics\OtlpAttributeValue\UnionMember1;
use ChunkifyAnalytics\OtlpAttributeValue\UnionMember2;
use ChunkifyAnalytics\OtlpAttributeValue\UnionMember3;
use ChunkifyAnalytics\OtlpAttributeValue\UnionMember4;
use ChunkifyAnalytics\OtlpAttributeValue\UnionMember5;
use ChunkifyAnalytics\OtlpAttributeValue\UnionMember6;

/**
 * A typed log attribute. At most one value field can be set. Binary values are unsupported.
 *
 * @phpstan-import-type UnionMember0Shape from \ChunkifyAnalytics\OtlpAttributeValue\UnionMember0
 * @phpstan-import-type UnionMember1Shape from \ChunkifyAnalytics\OtlpAttributeValue\UnionMember1
 * @phpstan-import-type UnionMember2Shape from \ChunkifyAnalytics\OtlpAttributeValue\UnionMember2
 * @phpstan-import-type UnionMember3Shape from \ChunkifyAnalytics\OtlpAttributeValue\UnionMember3
 * @phpstan-import-type UnionMember4Shape from \ChunkifyAnalytics\OtlpAttributeValue\UnionMember4
 * @phpstan-import-type UnionMember5Shape from \ChunkifyAnalytics\OtlpAttributeValue\UnionMember5
 * @phpstan-import-type UnionMember6Shape from \ChunkifyAnalytics\OtlpAttributeValue\UnionMember6
 *
 * @phpstan-type OtlpAttributeValueVariants = UnionMember0|UnionMember1|UnionMember2|UnionMember3|UnionMember4|UnionMember5|UnionMember6
 * @phpstan-type OtlpAttributeValueShape = OtlpAttributeValueVariants|UnionMember0Shape|UnionMember1Shape|UnionMember2Shape|UnionMember3Shape|UnionMember4Shape|UnionMember5Shape|UnionMember6Shape
 */
final class OtlpAttributeValue implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            UnionMember0::class,
            UnionMember1::class,
            UnionMember2::class,
            UnionMember3::class,
            UnionMember4::class,
            UnionMember5::class,
            UnionMember6::class,
        ];
    }
}
