<?php

namespace Tests\Services;

use ChunkifyAnalytics\Admin\CreatedProject;
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
final class AdminTest extends TestCase
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
    public function testCreateProject(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->admin->createProject(name: 'Customer website');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CreatedProject::class, $result);
    }

    #[Test]
    public function testCreateProjectWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->admin->createProject(
            name: 'Customer website',
            allowedOrigins: ['https://customer.example'],
            retentionSeconds: 2592000,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CreatedProject::class, $result);
    }
}
