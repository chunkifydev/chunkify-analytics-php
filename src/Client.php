<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\BaseClient;
use ChunkifyAnalytics\Core\Implementation\StreamingHttpClient;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\Services\AdminService;
use ChunkifyAnalytics\Services\DimensionsService;
use ChunkifyAnalytics\Services\EngagementService;
use ChunkifyAnalytics\Services\ErrorsService;
use ChunkifyAnalytics\Services\EventsService;
use ChunkifyAnalytics\Services\ExportsService;
use ChunkifyAnalytics\Services\HealthService;
use ChunkifyAnalytics\Services\PlaybackRatesService;
use ChunkifyAnalytics\Services\ProjectService;
use ChunkifyAnalytics\Services\QualityService;
use ChunkifyAnalytics\Services\RenditionsService;
use ChunkifyAnalytics\Services\RetentionService;
use ChunkifyAnalytics\Services\SubtitlesService;
use ChunkifyAnalytics\Services\SummaryService;
use ChunkifyAnalytics\Services\TimeseriesService;
use ChunkifyAnalytics\Services\VideosService;
use ChunkifyAnalytics\Services\ViewsService;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;

/**
 * @phpstan-import-type NormalizedRequest from \ChunkifyAnalytics\Core\BaseClient
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
class Client extends BaseClient
{
    public string $publicKey;

    public string $secretKey;

    public string $adminKey;

    /**
     * @api
     */
    public HealthService $health;

    /**
     * @api
     */
    public EventsService $events;

    /**
     * @api
     */
    public SummaryService $summary;

    /**
     * @api
     */
    public VideosService $videos;

    /**
     * @api
     */
    public TimeseriesService $timeseries;

    /**
     * @api
     */
    public QualityService $quality;

    /**
     * @api
     */
    public EngagementService $engagement;

    /**
     * @api
     */
    public ProjectService $project;

    /**
     * @api
     */
    public AdminService $admin;

    /**
     * @api
     */
    public ViewsService $views;

    /**
     * @api
     */
    public ErrorsService $errors;

    /**
     * @api
     */
    public DimensionsService $dimensions;

    /**
     * @api
     */
    public ExportsService $exports;

    /**
     * @api
     */
    public RetentionService $retention;

    /**
     * @api
     */
    public RenditionsService $renditions;

    /**
     * @api
     */
    public SubtitlesService $subtitles;

    /**
     * @api
     */
    public PlaybackRatesService $playbackRates;

    /**
     * @param RequestOpts|null $requestOptions
     */
    public function __construct(
        ?string $publicKey = null,
        ?string $secretKey = null,
        ?string $adminKey = null,
        ?string $baseUrl = null,
        RequestOptions|array|null $requestOptions = null,
    ) {
        $this->publicKey = (string) ($publicKey ?? Util::getenv(
            'CHUNKIFY_ANALYTICS_PUBLIC_KEY'
        ));
        $this->secretKey = (string) ($secretKey ?? Util::getenv(
            'CHUNKIFY_ANALYTICS_SECRET_KEY'
        ));
        $this->adminKey = (string) ($adminKey ?? Util::getenv(
            'CHUNKIFY_ANALYTICS_ADMIN_KEY'
        ));

        $baseUrl ??= Util::getenv(
            'CHUNKIFY_ANALYTICS_BASE_URL'
        ) ?: 'https://analytics.chunkify.dev';

        $options = RequestOptions::parse(
            RequestOptions::with(
                uriFactory: Psr17FactoryDiscovery::findUriFactory(),
                streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
                requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
                transporter: Psr18ClientDiscovery::find(),
            ),
            $requestOptions,
        );

        if (is_null($options->streamingTransporter)) {
            assert(!is_null($options->transporter));
            $options->streamingTransporter = new StreamingHttpClient($options->transporter);
        }

        /** @var array<string, string|null> $headers */
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => sprintf('Chunkify Analytics/PHP %s', VERSION),
            'X-Stainless-Lang' => 'php',
            'X-Stainless-Package-Version' => VERSION,
            'X-Stainless-Arch' => Util::machtype(),
            'X-Stainless-OS' => Util::ostype(),
            'X-Stainless-Runtime' => php_sapi_name(),
            'X-Stainless-Runtime-Version' => phpversion(),
        ];

        $customHeadersEnv = Util::getenv('CHUNKIFY_ANALYTICS_CUSTOM_HEADERS');
        if (null !== $customHeadersEnv) {
            foreach (explode("\n", $customHeadersEnv) as $line) {
                $colon = strpos($line, ':');
                if (false !== $colon) {
                    $headers[trim(substr($line, 0, $colon))] = trim(substr($line, $colon + 1));
                }
            }
        }

        parent::__construct(
            headers: $headers,
            baseUrl: $baseUrl,
            options: $options
        );

        $this->health = new HealthService($this);
        $this->events = new EventsService($this);
        $this->summary = new SummaryService($this);
        $this->videos = new VideosService($this);
        $this->timeseries = new TimeseriesService($this);
        $this->quality = new QualityService($this);
        $this->engagement = new EngagementService($this);
        $this->project = new ProjectService($this);
        $this->admin = new AdminService($this);
        $this->views = new ViewsService($this);
        $this->errors = new ErrorsService($this);
        $this->dimensions = new DimensionsService($this);
        $this->exports = new ExportsService($this);
        $this->retention = new RetentionService($this);
        $this->renditions = new RenditionsService($this);
        $this->subtitles = new SubtitlesService($this);
        $this->playbackRates = new PlaybackRatesService($this);
    }

    /**
     * @param array{publicKey?: bool, secretKey?: bool, adminKey?: bool} $security
     *
     * @return array<string,string>
     */
    protected function authHeaders(array $security): array
    {
        return [
            ...($security['publicKey'] ?? false) ? $this->publicKeyScheme() : [],
            ...($security['secretKey'] ?? false) ? $this->secretKeyScheme() : [],
            ...($security['adminKey'] ?? false) ? $this->adminKeyScheme() : [],
        ];
    }

    /** @return array<string,string> */
    protected function publicKeyScheme(): array
    {
        return $this->publicKey ? ['X-Chunkify-Ingest-Key' => $this->publicKey] : [
        ];
    }

    /** @return array<string,string> */
    protected function secretKeyScheme(): array
    {
        return $this->secretKey ? [
            'Authorization' => "Bearer {$this->secretKey}",
        ] : [];
    }

    /** @return array<string,string> */
    protected function adminKeyScheme(): array
    {
        return $this->adminKey ? ['Authorization' => "Bearer {$this->adminKey}"] : [
        ];
    }

    /**
     * @internal
     *
     * @param string|list<string> $path
     * @param array<string,mixed> $query
     * @param array<string,string|int|list<string|int>|null> $headers
     * @param RequestOpts|null $opts
     * @param array{publicKey?: bool, secretKey?: bool, adminKey?: bool}|null $security
     *
     * @return array{NormalizedRequest, RequestOptions}
     */
    protected function buildRequest(
        string $method,
        string|array $path,
        array $query,
        array $headers,
        mixed $body,
        RequestOptions|array|null $opts,
        ?array $security = null,
    ): array {
        return parent::buildRequest(
            method: $method,
            path: $path,
            query: $query,
            headers: [
                ...$this->authHeaders(
                    security: ($security ?? [
                        'publicKey' => true, 'secretKey' => true, 'adminKey' => true,
                    ]),
                ),
                ...$headers,
            ],
            body: $body,
            opts: $opts,
            security: $security,
        );
    }
}
