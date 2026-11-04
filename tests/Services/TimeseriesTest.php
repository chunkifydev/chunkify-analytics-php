<?php

namespace Tests\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class TimeseriesTest extends TestCase
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

        $result = $this->client->timeseries->retrieve(
            from: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            interval: 'hour',
            to: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->timeseries->retrieve(
            from: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            interval: 'hour',
            to: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            browserName: 'x',
            city: 'x',
            continent: 'AF',
            country: 'SE',
            deviceType: 'desktop',
            kind: 'summary',
            osName: 'x',
            pageOrigin: 'x',
            pagePath: 'x',
            videoID: 'video_id',
            viewID: 'x',
            viewerID: 'viewer_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }
}
