<?php

namespace Tests\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\Project\DeletedProject;
use ChunkifyAnalytics\Project\Project;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class ProjectTest extends TestCase
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
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->project->update();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Project::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->project->delete();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeletedProject::class, $result);
    }
}
