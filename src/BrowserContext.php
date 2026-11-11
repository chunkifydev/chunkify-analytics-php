<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\BrowserContext\DeviceType;
use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Omit;

/**
 * Browser and device information. The Chunkify player sends every field, with null for unavailable measurements. Other integrations may omit any field except schema_version. Extra properties are preserved.
 *
 * @phpstan-type BrowserContextShape = array{
 *   schemaVersion: 1,
 *   browserName?: string|null,
 *   browserVersion?: string|null,
 *   deviceFamily?: string|null,
 *   deviceType?: null|DeviceType|value-of<DeviceType>,
 *   language?: string|null,
 *   languagePrefix?: string|null,
 *   osName?: string|null,
 *   osVersion?: string|null,
 *   pageOrigin?: string|null,
 *   pagePath?: string|null,
 *   pixelRatio?: float|null,
 *   screenHeightPx?: int|null,
 *   screenWidthPx?: int|null,
 *   timezone?: string|null,
 *   timezoneOffsetMinutes?: int|null,
 *   userAgent?: string|null,
 *   viewportHeightPx?: int|null,
 *   viewportWidthPx?: int|null,
 * }
 */
final class BrowserContext implements BaseModel
{
    /** @use SdkModel<BrowserContextShape> */
    use SdkModel;

    /** @var 1 $schemaVersion */
    #[Required('schema_version')]
    public int $schemaVersion = 1;

    #[Optional('browser_name', nullable: true)]
    public ?string $browserName;

    #[Optional('browser_version', nullable: true)]
    public ?string $browserVersion;

    #[Optional('device_family', nullable: true)]
    public ?string $deviceFamily;

    /** @var value-of<DeviceType>|null $deviceType */
    #[Optional('device_type', enum: DeviceType::class)]
    public ?string $deviceType;

    #[Optional(nullable: true)]
    public ?string $language;

    #[Optional('language_prefix', nullable: true)]
    public ?string $languagePrefix;

    #[Optional('os_name', nullable: true)]
    public ?string $osName;

    #[Optional('os_version', nullable: true)]
    public ?string $osVersion;

    /**
     * Current document HTTP(S) origin, without credentials. Null when unavailable or longer than 2048 characters.
     */
    #[Optional('page_origin', nullable: true)]
    public ?string $pageOrigin;

    /**
     * Current document pathname, without query parameters or fragment. Null when unavailable or longer than 2048 characters. Paths may contain application-defined identifiers.
     */
    #[Optional('page_path', nullable: true)]
    public ?string $pagePath;

    #[Optional('pixel_ratio', nullable: true)]
    public ?float $pixelRatio;

    #[Optional('screen_height_px', nullable: true)]
    public ?int $screenHeightPx;

    #[Optional('screen_width_px', nullable: true)]
    public ?int $screenWidthPx;

    #[Optional(nullable: true)]
    public ?string $timezone;

    #[Optional('timezone_offset_minutes', nullable: true)]
    public ?int $timezoneOffsetMinutes;

    #[Optional('user_agent', nullable: true)]
    public ?string $userAgent;

    #[Optional('viewport_height_px', nullable: true)]
    public ?int $viewportHeightPx;

    #[Optional('viewport_width_px', nullable: true)]
    public ?int $viewportWidthPx;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param DeviceType|value-of<DeviceType>|null $deviceType
     */
    public static function with(
        string|Omit|null $browserName = Omit::Value,
        string|Omit|null $browserVersion = Omit::Value,
        string|Omit|null $deviceFamily = Omit::Value,
        DeviceType|string|null $deviceType = null,
        string|Omit|null $language = Omit::Value,
        string|Omit|null $languagePrefix = Omit::Value,
        string|Omit|null $osName = Omit::Value,
        string|Omit|null $osVersion = Omit::Value,
        string|Omit|null $pageOrigin = Omit::Value,
        string|Omit|null $pagePath = Omit::Value,
        float|Omit|null $pixelRatio = Omit::Value,
        int|Omit|null $screenHeightPx = Omit::Value,
        int|Omit|null $screenWidthPx = Omit::Value,
        string|Omit|null $timezone = Omit::Value,
        int|Omit|null $timezoneOffsetMinutes = Omit::Value,
        string|Omit|null $userAgent = Omit::Value,
        int|Omit|null $viewportHeightPx = Omit::Value,
        int|Omit|null $viewportWidthPx = Omit::Value,
    ): self {
        $self = new self;

        Omit::Value !== $browserName && $self['browserName'] = $browserName;
        Omit::Value !== $browserVersion && $self['browserVersion'] = $browserVersion;
        Omit::Value !== $deviceFamily && $self['deviceFamily'] = $deviceFamily;
        null !== $deviceType && $self['deviceType'] = $deviceType;
        Omit::Value !== $language && $self['language'] = $language;
        Omit::Value !== $languagePrefix && $self['languagePrefix'] = $languagePrefix;
        Omit::Value !== $osName && $self['osName'] = $osName;
        Omit::Value !== $osVersion && $self['osVersion'] = $osVersion;
        Omit::Value !== $pageOrigin && $self['pageOrigin'] = $pageOrigin;
        Omit::Value !== $pagePath && $self['pagePath'] = $pagePath;
        Omit::Value !== $pixelRatio && $self['pixelRatio'] = $pixelRatio;
        Omit::Value !== $screenHeightPx && $self['screenHeightPx'] = $screenHeightPx;
        Omit::Value !== $screenWidthPx && $self['screenWidthPx'] = $screenWidthPx;
        Omit::Value !== $timezone && $self['timezone'] = $timezone;
        Omit::Value !== $timezoneOffsetMinutes && $self['timezoneOffsetMinutes'] = $timezoneOffsetMinutes;
        Omit::Value !== $userAgent && $self['userAgent'] = $userAgent;
        Omit::Value !== $viewportHeightPx && $self['viewportHeightPx'] = $viewportHeightPx;
        Omit::Value !== $viewportWidthPx && $self['viewportWidthPx'] = $viewportWidthPx;

        return $self;
    }

    /**
     * @param 1 $schemaVersion
     */
    public function withSchemaVersion(int $schemaVersion): self
    {
        $self = clone $this;
        $self['schemaVersion'] = $schemaVersion;

        return $self;
    }

    public function withBrowserName(?string $browserName): self
    {
        $self = clone $this;
        $self['browserName'] = $browserName;

        return $self;
    }

    public function withBrowserVersion(?string $browserVersion): self
    {
        $self = clone $this;
        $self['browserVersion'] = $browserVersion;

        return $self;
    }

    public function withDeviceFamily(?string $deviceFamily): self
    {
        $self = clone $this;
        $self['deviceFamily'] = $deviceFamily;

        return $self;
    }

    /**
     * @param DeviceType|value-of<DeviceType> $deviceType
     */
    public function withDeviceType(DeviceType|string $deviceType): self
    {
        $self = clone $this;
        $self['deviceType'] = $deviceType;

        return $self;
    }

    public function withLanguage(?string $language): self
    {
        $self = clone $this;
        $self['language'] = $language;

        return $self;
    }

    public function withLanguagePrefix(?string $languagePrefix): self
    {
        $self = clone $this;
        $self['languagePrefix'] = $languagePrefix;

        return $self;
    }

    public function withOsName(?string $osName): self
    {
        $self = clone $this;
        $self['osName'] = $osName;

        return $self;
    }

    public function withOsVersion(?string $osVersion): self
    {
        $self = clone $this;
        $self['osVersion'] = $osVersion;

        return $self;
    }

    /**
     * Current document HTTP(S) origin, without credentials. Null when unavailable or longer than 2048 characters.
     */
    public function withPageOrigin(?string $pageOrigin): self
    {
        $self = clone $this;
        $self['pageOrigin'] = $pageOrigin;

        return $self;
    }

    /**
     * Current document pathname, without query parameters or fragment. Null when unavailable or longer than 2048 characters. Paths may contain application-defined identifiers.
     */
    public function withPagePath(?string $pagePath): self
    {
        $self = clone $this;
        $self['pagePath'] = $pagePath;

        return $self;
    }

    public function withPixelRatio(?float $pixelRatio): self
    {
        $self = clone $this;
        $self['pixelRatio'] = $pixelRatio;

        return $self;
    }

    public function withScreenHeightPx(?int $screenHeightPx): self
    {
        $self = clone $this;
        $self['screenHeightPx'] = $screenHeightPx;

        return $self;
    }

    public function withScreenWidthPx(?int $screenWidthPx): self
    {
        $self = clone $this;
        $self['screenWidthPx'] = $screenWidthPx;

        return $self;
    }

    public function withTimezone(?string $timezone): self
    {
        $self = clone $this;
        $self['timezone'] = $timezone;

        return $self;
    }

    public function withTimezoneOffsetMinutes(?int $timezoneOffsetMinutes): self
    {
        $self = clone $this;
        $self['timezoneOffsetMinutes'] = $timezoneOffsetMinutes;

        return $self;
    }

    public function withUserAgent(?string $userAgent): self
    {
        $self = clone $this;
        $self['userAgent'] = $userAgent;

        return $self;
    }

    public function withViewportHeightPx(?int $viewportHeightPx): self
    {
        $self = clone $this;
        $self['viewportHeightPx'] = $viewportHeightPx;

        return $self;
    }

    public function withViewportWidthPx(?int $viewportWidthPx): self
    {
        $self = clone $this;
        $self['viewportWidthPx'] = $viewportWidthPx;

        return $self;
    }
}
