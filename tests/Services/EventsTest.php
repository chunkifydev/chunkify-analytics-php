<?php

namespace Tests\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\Events\StoredEvent;
use ChunkifyAnalytics\EventsPage;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class EventsTest extends TestCase
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
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $page = $this->client->events->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EventsPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(StoredEvent::class, $item);
        }
    }

    #[Test]
    public function testIngest(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->events->ingest(
            event: [
                'connectorName' => 'html-media',
                'connectorVersion' => null,
                'deliveryHostname' => null,
                'deliveryRequestCount' => null,
                'deliveryThroughputBps' => null,
                'deliveryTransferredBytes' => null,
                'droppedVideoFrames' => null,
                'environment' => null,
                'errorCategory' => null,
                'errorCode' => 'string',
                'errorFatal' => null,
                'errorPlayheadSeconds' => null,
                'eventID' => '35c9ab04-7c09-4c09-ae70-a214f4a637c0',
                'eventName' => 'chunkify.video.view_started',
                'firstVideoFrameTimeMs' => null,
                'furthestProgressRatio' => null,
                'maximumPlayheadSeconds' => 0,
                'mediaDurationSeconds' => null,
                'mediaHeightPx' => null,
                'mediaWidthPx' => null,
                'occurredAt' => new \DateTimeImmutable('2026-10-19T12:00:00.000Z'),
                'playerHeightPx' => null,
                'playerName' => null,
                'playerVersion' => null,
                'playerWidthPx' => null,
                'playingTimeMs' => 0,
                'reason' => null,
                'rebufferCount' => 0,
                'rebufferDurationMs' => 0,
                'rebufferRatio' => null,
                'renditionPlayingTime' => [
                    [
                        'bitrateBps' => 0,
                        'codec' => 'codec',
                        'frameRate' => 0,
                        'height' => 0,
                        'playingTimeMs' => 0,
                        'width' => 0,
                    ],
                ],
                'renditionSwitchCount' => null,
                'schemaVersion' => 1,
                'sdkName' => '@chunkify/player-analytics',
                'sdkVersion' => '0.3.0',
                'seekCount' => 0,
                'seekDurationMs' => 0,
                'selectedRenditionBitrateBps' => null,
                'selectedRenditionCodec' => null,
                'selectedRenditionHeight' => null,
                'selectedRenditionWidth' => null,
                'sequence' => 1,
                'startupOutcome' => null,
                'startupTimeMs' => null,
                'totalVideoFrames' => null,
                'videoID' => 'demo-video',
                'viewID' => '616992d2-6db6-4578-8361-3f8813e963be',
                'viewerID' => null,
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testIngestWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->events->ingest(
            event: [
                'connectorName' => 'html-media',
                'connectorVersion' => null,
                'deliveryHostname' => null,
                'deliveryRequestCount' => null,
                'deliveryThroughputBps' => null,
                'deliveryTransferredBytes' => null,
                'droppedVideoFrames' => null,
                'environment' => null,
                'errorCategory' => null,
                'errorCode' => 'string',
                'errorFatal' => null,
                'errorPlayheadSeconds' => null,
                'eventID' => '35c9ab04-7c09-4c09-ae70-a214f4a637c0',
                'eventName' => 'chunkify.video.view_started',
                'firstVideoFrameTimeMs' => null,
                'furthestProgressRatio' => null,
                'maximumPlayheadSeconds' => 0,
                'mediaDurationSeconds' => null,
                'mediaHeightPx' => null,
                'mediaWidthPx' => null,
                'occurredAt' => new \DateTimeImmutable('2026-10-19T12:00:00.000Z'),
                'playerHeightPx' => null,
                'playerName' => null,
                'playerVersion' => null,
                'playerWidthPx' => null,
                'playingTimeMs' => 0,
                'reason' => null,
                'rebufferCount' => 0,
                'rebufferDurationMs' => 0,
                'rebufferRatio' => null,
                'renditionPlayingTime' => [
                    [
                        'bitrateBps' => 0,
                        'codec' => 'codec',
                        'frameRate' => 0,
                        'height' => 0,
                        'playingTimeMs' => 0,
                        'width' => 0,
                    ],
                ],
                'renditionSwitchCount' => null,
                'schemaVersion' => 1,
                'sdkName' => '@chunkify/player-analytics',
                'sdkVersion' => '0.3.0',
                'seekCount' => 0,
                'seekDurationMs' => 0,
                'selectedRenditionBitrateBps' => null,
                'selectedRenditionCodec' => null,
                'selectedRenditionHeight' => null,
                'selectedRenditionWidth' => null,
                'sequence' => 1,
                'startupOutcome' => null,
                'startupTimeMs' => null,
                'totalVideoFrames' => null,
                'videoID' => 'demo-video',
                'viewID' => '616992d2-6db6-4578-8361-3f8813e963be',
                'viewerID' => null,
                'browserContext' => (object) [],
                'custom' => [
                    'plan' => 'premium', 'ab_test' => 'B', 'seats' => 5, 'trial' => false,
                ],
                'playbackRate' => 0.01,
                'playbackRatePlayingTime' => [['playingTimeMs' => 0, 'rate' => 0.01]],
                'playedRanges' => [['endSeconds' => 0, 'startSeconds' => 0]],
                'playheadSeconds' => 0,
                'subtitleLanguage' => 'P',
                'subtitlePlayingTime' => [['language' => 'P', 'playingTimeMs' => 0]],
                'userID' => 'x',
                'videoTitle' => 'x',
                'visibilityState' => 'visible',
            ],
            contentEncoding: 'identity',
            origin: 'Origin',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }
}
