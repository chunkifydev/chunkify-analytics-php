<?php

namespace Tests\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\Exports\Export;
use ChunkifyAnalytics\Exports\ExportColumns;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class ExportsTest extends TestCase
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
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->exports->create(resource: 'videos');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Export::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->exports->create(
            resource: 'videos',
            columns: ['x'],
            query: [
                'browserName' => 'x',
                'city' => 'x',
                'continent' => 'AF',
                'country' => 'SE',
                'deviceType' => 'desktop',
                'dimension' => 'browser_name',
                'eventName' => 'chunkify.video.view_started',
                'from' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                'groupBy' => 'browser_name',
                'hasFatalError' => true,
                'interval' => 'hour',
                'kind' => 'summary',
                'order' => 'desc',
                'osName' => 'x',
                'pageOrigin' => 'x',
                'pagePath' => 'x',
                'playbackRate' => '269125115713',
                'sortBy' => 'views',
                'subtitleLanguage' => 'P',
                'to' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                'userID' => 'x',
                'videoID' => 'P',
                'videoTitle' => 'x',
                'viewID' => 'x',
                'viewerID' => 'x',
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Export::class, $result);
    }

    #[Test]
    public function testDownload(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->exports->download(
            '2e-xAv1b-zE_-N_eC1_0f_sO_-a-i_D--_3f-__c703'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsString($result);
    }

    #[Test]
    public function testListColumns(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->exports->listColumns(resource: 'summary');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ExportColumns::class, $result);
    }

    #[Test]
    public function testListColumnsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->exports->listColumns(
            resource: 'summary',
            groupBy: 'browser_name',
            kind: 'summary'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ExportColumns::class, $result);
    }
}
