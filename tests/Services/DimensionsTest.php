<?php

namespace Tests\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\Dimensions\DimensionValues\Value;
use ChunkifyAnalytics\DimensionValuesPage;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class DimensionsTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(
            publicKey: 'My Public Key',
            secretKey: 'My Secret Key',
            adminKey: 'My Admin Key',
            baseUrl: $testUrl,
        );

        $this->client = $client;
    }

    #[Test]
    public function testListValues(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $page = $this->client->dimensions->listValues('browser_name');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DimensionValuesPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Value::class, $item);
        }
    }
}
