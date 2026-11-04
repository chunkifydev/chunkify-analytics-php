<?php

namespace Tests\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\Retention\RetentionReport;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class RetentionTest extends TestCase
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
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->retention->retrieve(videoID: 'video_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RetentionReport::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->retention->retrieve(
            videoID: 'video_id',
            browserName: 'x',
            city: 'x',
            continent: 'AF',
            country: 'SE',
            deviceType: 'desktop',
            from: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            osName: 'x',
            pageOrigin: 'x',
            pagePath: 'x',
            to: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            viewID: 'x',
            viewerID: 'viewer_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RetentionReport::class, $result);
    }
}
