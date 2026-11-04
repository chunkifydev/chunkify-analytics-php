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
 * Browser and device information reported by the player. Unavailable measurements are null.
 *
 * @phpstan-type BrowserContextShape = array{
 *   browserName: string|null,
 *   browserVersion: string|null,
 *   deviceFamily: string|null,
 *   deviceType: DeviceType|value-of<DeviceType>,
 *   language: string|null,
 *   languagePrefix: string|null,
 *   osName: string|null,
 *   osVersion: string|null,
 *   pixelRatio: float|null,
 *   schemaVersion: 1,
 *   screenHeightPx: int|null,
 *   screenWidthPx: int|null,
 *   timezone: string|null,
 *   timezoneOffsetMinutes: int|null,
 *   userAgent: string|null,
 *   viewportHeightPx: int|null,
 *   viewportWidthPx: int|null,
 *   pageOrigin?: string|null,
 *   pagePath?: string|null,
 * }
 */
final class BrowserContext implements BaseModel
{
    /** @use SdkModel<BrowserContextShape> */
    use SdkModel;

    /** @var 1 $schemaVersion */
    #[Required('schema_version')]
    public int $schemaVersion = 1;

    #[Required('browser_name')]
    public ?string $browserName;

    #[Required('browser_version')]
    public ?string $browserVersion;

    #[Required('device_family')]
    public ?string $deviceFamily;

    /** @var value-of<DeviceType> $deviceType */
    #[Required('device_type', enum: DeviceType::class)]
    public string $deviceType;

    #[Required]
    public ?string $language;

    #[Required('language_prefix')]
    public ?string $languagePrefix;

    #[Required('os_name')]
    public ?string $osName;

    #[Required('os_version')]
    public ?string $osVersion;

    #[Required('pixel_ratio')]
    public ?float $pixelRatio;

    #[Required('screen_height_px')]
    public ?int $screenHeightPx;

    #[Required('screen_width_px')]
    public ?int $screenWidthPx;

    #[Required]
    public ?string $timezone;

    #[Required('timezone_offset_minutes')]
    public ?int $timezoneOffsetMinutes;

    #[Required('user_agent')]
    public ?string $userAgent;

    #[Required('viewport_height_px')]
    public ?int $viewportHeightPx;

    #[Required('viewport_width_px')]
    public ?int $viewportWidthPx;

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

    /**
     * `new BrowserContext()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrowserContext::with(
     *   browserName: ...,
     *   browserVersion: ...,
     *   deviceFamily: ...,
     *   deviceType: ...,
     *   language: ...,
     *   languagePrefix: ...,
     *   osName: ...,
     *   osVersion: ...,
     *   pixelRatio: ...,
     *   screenHeightPx: ...,
     *   screenWidthPx: ...,
     *   timezone: ...,
     *   timezoneOffsetMinutes: ...,
     *   userAgent: ...,
     *   viewportHeightPx: ...,
     *   viewportWidthPx: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrowserContext)
     *   ->withBrowserName(...)
     *   ->withBrowserVersion(...)
     *   ->withDeviceFamily(...)
     *   ->withDeviceType(...)
     *   ->withLanguage(...)
     *   ->withLanguagePrefix(...)
     *   ->withOsName(...)
     *   ->withOsVersion(...)
     *   ->withPixelRatio(...)
     *   ->withScreenHeightPx(...)
     *   ->withScreenWidthPx(...)
     *   ->withTimezone(...)
     *   ->withTimezoneOffsetMinutes(...)
     *   ->withUserAgent(...)
     *   ->withViewportHeightPx(...)
     *   ->withViewportWidthPx(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param DeviceType|value-of<DeviceType> $deviceType
     */
    public static function with(
        ?string $browserName,
        ?string $browserVersion,
        ?string $deviceFamily,
        DeviceType|string $deviceType,
        ?string $language,
        ?string $languagePrefix,
        ?string $osName,
        ?string $osVersion,
        ?float $pixelRatio,
        ?int $screenHeightPx,
        ?int $screenWidthPx,
        ?string $timezone,
        ?int $timezoneOffsetMinutes,
        ?string $userAgent,
        ?int $viewportHeightPx,
        ?int $viewportWidthPx,
        string|Omit|null $pageOrigin = Omit::Value,
        string|Omit|null $pagePath = Omit::Value,
    ): self {
        $self = new self;

        $self['browserName'] = $browserName;
        $self['browserVersion'] = $browserVersion;
        $self['deviceFamily'] = $deviceFamily;
        $self['deviceType'] = $deviceType;
        $self['language'] = $language;
        $self['languagePrefix'] = $languagePrefix;
        $self['osName'] = $osName;
        $self['osVersion'] = $osVersion;
        $self['pixelRatio'] = $pixelRatio;
        $self['screenHeightPx'] = $screenHeightPx;
        $self['screenWidthPx'] = $screenWidthPx;
        $self['timezone'] = $timezone;
        $self['timezoneOffsetMinutes'] = $timezoneOffsetMinutes;
        $self['userAgent'] = $userAgent;
        $self['viewportHeightPx'] = $viewportHeightPx;
        $self['viewportWidthPx'] = $viewportWidthPx;

        Omit::Value !== $pageOrigin && $self['pageOrigin'] = $pageOrigin;
        Omit::Value !== $pagePath && $self['pagePath'] = $pagePath;

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

    public function withPixelRatio(?float $pixelRatio): self
    {
        $self = clone $this;
        $self['pixelRatio'] = $pixelRatio;

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
}
