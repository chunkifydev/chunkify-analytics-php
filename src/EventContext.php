<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Omit;
use ChunkifyAnalytics\EventContext\Continent;

/**
 * Browser context and locally derived continent/country/city. Request IP addresses are never added to events or stored context.
 *
 * @phpstan-import-type BrowserNameVariants from \ChunkifyAnalytics\EventContext\BrowserName
 * @phpstan-import-type BrowserVersionVariants from \ChunkifyAnalytics\EventContext\BrowserVersion
 * @phpstan-import-type DeviceFamilyVariants from \ChunkifyAnalytics\EventContext\DeviceFamily
 * @phpstan-import-type DeviceTypeVariants from \ChunkifyAnalytics\EventContext\DeviceType
 * @phpstan-import-type LanguageVariants from \ChunkifyAnalytics\EventContext\Language
 * @phpstan-import-type LanguagePrefixVariants from \ChunkifyAnalytics\EventContext\LanguagePrefix
 * @phpstan-import-type OsNameVariants from \ChunkifyAnalytics\EventContext\OsName
 * @phpstan-import-type OsVersionVariants from \ChunkifyAnalytics\EventContext\OsVersion
 * @phpstan-import-type PixelRatioVariants from \ChunkifyAnalytics\EventContext\PixelRatio
 * @phpstan-import-type ScreenHeightPxVariants from \ChunkifyAnalytics\EventContext\ScreenHeightPx
 * @phpstan-import-type ScreenWidthPxVariants from \ChunkifyAnalytics\EventContext\ScreenWidthPx
 * @phpstan-import-type TimezoneVariants from \ChunkifyAnalytics\EventContext\Timezone
 * @phpstan-import-type TimezoneOffsetMinutesVariants from \ChunkifyAnalytics\EventContext\TimezoneOffsetMinutes
 * @phpstan-import-type UserAgentVariants from \ChunkifyAnalytics\EventContext\UserAgent
 * @phpstan-import-type ViewportHeightPxVariants from \ChunkifyAnalytics\EventContext\ViewportHeightPx
 * @phpstan-import-type ViewportWidthPxVariants from \ChunkifyAnalytics\EventContext\ViewportWidthPx
 * @phpstan-import-type BrowserNameShape from \ChunkifyAnalytics\EventContext\BrowserName
 * @phpstan-import-type BrowserVersionShape from \ChunkifyAnalytics\EventContext\BrowserVersion
 * @phpstan-import-type DeviceFamilyShape from \ChunkifyAnalytics\EventContext\DeviceFamily
 * @phpstan-import-type DeviceTypeShape from \ChunkifyAnalytics\EventContext\DeviceType
 * @phpstan-import-type LanguageShape from \ChunkifyAnalytics\EventContext\Language
 * @phpstan-import-type LanguagePrefixShape from \ChunkifyAnalytics\EventContext\LanguagePrefix
 * @phpstan-import-type OsNameShape from \ChunkifyAnalytics\EventContext\OsName
 * @phpstan-import-type OsVersionShape from \ChunkifyAnalytics\EventContext\OsVersion
 * @phpstan-import-type PixelRatioShape from \ChunkifyAnalytics\EventContext\PixelRatio
 * @phpstan-import-type ScreenHeightPxShape from \ChunkifyAnalytics\EventContext\ScreenHeightPx
 * @phpstan-import-type ScreenWidthPxShape from \ChunkifyAnalytics\EventContext\ScreenWidthPx
 * @phpstan-import-type TimezoneShape from \ChunkifyAnalytics\EventContext\Timezone
 * @phpstan-import-type TimezoneOffsetMinutesShape from \ChunkifyAnalytics\EventContext\TimezoneOffsetMinutes
 * @phpstan-import-type UserAgentShape from \ChunkifyAnalytics\EventContext\UserAgent
 * @phpstan-import-type ViewportHeightPxShape from \ChunkifyAnalytics\EventContext\ViewportHeightPx
 * @phpstan-import-type ViewportWidthPxShape from \ChunkifyAnalytics\EventContext\ViewportWidthPx
 *
 * @phpstan-type EventContextShape = array{
 *   schemaVersion: 1,
 *   browserName?: BrowserNameShape|null,
 *   browserVersion?: BrowserVersionShape|null,
 *   city?: string|null,
 *   continent?: null|Continent|value-of<Continent>,
 *   country?: string|null,
 *   deviceFamily?: DeviceFamilyShape|null,
 *   deviceType?: DeviceTypeShape|null,
 *   language?: LanguageShape|null,
 *   languagePrefix?: LanguagePrefixShape|null,
 *   osName?: OsNameShape|null,
 *   osVersion?: OsVersionShape|null,
 *   pageOrigin?: string|null,
 *   pagePath?: string|null,
 *   pixelRatio?: PixelRatioShape|null,
 *   screenHeightPx?: ScreenHeightPxShape|null,
 *   screenWidthPx?: ScreenWidthPxShape|null,
 *   timezone?: TimezoneShape|null,
 *   timezoneOffsetMinutes?: TimezoneOffsetMinutesShape|null,
 *   userAgent?: UserAgentShape|null,
 *   viewportHeightPx?: ViewportHeightPxShape|null,
 *   viewportWidthPx?: ViewportWidthPxShape|null,
 * }
 */
final class EventContext implements BaseModel
{
    /** @use SdkModel<EventContextShape> */
    use SdkModel;

    /** @var 1 $schemaVersion */
    #[Required('schema_version')]
    public int $schemaVersion = 1;

    /**
     * Copied from browser_context.browser_name when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @var BrowserNameVariants|null $browserName
     */
    #[Optional('browser_name', nullable: true)]
    public string|float|bool|null $browserName;

    /**
     * Copied from browser_context.browser_version when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @var BrowserVersionVariants|null $browserVersion
     */
    #[Optional('browser_version', nullable: true)]
    public string|float|bool|null $browserVersion;

    /**
     * Approximate city name in English from the local City MMDB lookup. Null when unknown. Location displays using the bundled DB-IP data must link to https://db-ip.com.
     */
    #[Optional(nullable: true)]
    public ?string $city;

    /**
     * Continent code from the local City MMDB lookup: Africa, Antarctica, Asia, Europe, North America, Oceania or South America. Null when unknown.
     *
     * @var value-of<Continent>|null $continent
     */
    #[Optional(enum: Continent::class, nullable: true)]
    public ?string $continent;

    /**
     * Country ISO 3166-1 alpha-2 code from the local City MMDB lookup. Null when unknown. The request IP is discarded.
     */
    #[Optional(nullable: true)]
    public ?string $country;

    /**
     * Copied from browser_context.device_family when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @var DeviceFamilyVariants|null $deviceFamily
     */
    #[Optional('device_family', nullable: true)]
    public string|float|bool|null $deviceFamily;

    /**
     * Copied from browser_context.device_type when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @var DeviceTypeVariants|null $deviceType
     */
    #[Optional('device_type', nullable: true)]
    public string|float|bool|null $deviceType;

    /**
     * Copied from browser_context.language when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @var LanguageVariants|null $language
     */
    #[Optional(nullable: true)]
    public string|float|bool|null $language;

    /**
     * Copied from browser_context.language_prefix when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @var LanguagePrefixVariants|null $languagePrefix
     */
    #[Optional('language_prefix', nullable: true)]
    public string|float|bool|null $languagePrefix;

    /**
     * Copied from browser_context.os_name when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @var OsNameVariants|null $osName
     */
    #[Optional('os_name', nullable: true)]
    public string|float|bool|null $osName;

    /**
     * Copied from browser_context.os_version when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @var OsVersionVariants|null $osVersion
     */
    #[Optional('os_version', nullable: true)]
    public string|float|bool|null $osVersion;

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
     * Copied from browser_context.pixel_ratio when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @var PixelRatioVariants|null $pixelRatio
     */
    #[Optional('pixel_ratio', nullable: true)]
    public string|float|bool|null $pixelRatio;

    /**
     * Copied from browser_context.screen_height_px when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @var ScreenHeightPxVariants|null $screenHeightPx
     */
    #[Optional('screen_height_px', nullable: true)]
    public string|float|bool|null $screenHeightPx;

    /**
     * Copied from browser_context.screen_width_px when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @var ScreenWidthPxVariants|null $screenWidthPx
     */
    #[Optional('screen_width_px', nullable: true)]
    public string|float|bool|null $screenWidthPx;

    /**
     * Copied from browser_context.timezone when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @var TimezoneVariants|null $timezone
     */
    #[Optional(nullable: true)]
    public string|float|bool|null $timezone;

    /**
     * Copied from browser_context.timezone_offset_minutes when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @var TimezoneOffsetMinutesVariants|null $timezoneOffsetMinutes
     */
    #[Optional('timezone_offset_minutes', nullable: true)]
    public string|float|bool|null $timezoneOffsetMinutes;

    /**
     * Copied from browser_context.user_agent when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @var UserAgentVariants|null $userAgent
     */
    #[Optional('user_agent', nullable: true)]
    public string|float|bool|null $userAgent;

    /**
     * Copied from browser_context.viewport_height_px when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @var ViewportHeightPxVariants|null $viewportHeightPx
     */
    #[Optional('viewport_height_px', nullable: true)]
    public string|float|bool|null $viewportHeightPx;

    /**
     * Copied from browser_context.viewport_width_px when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @var ViewportWidthPxVariants|null $viewportWidthPx
     */
    #[Optional('viewport_width_px', nullable: true)]
    public string|float|bool|null $viewportWidthPx;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param BrowserNameShape|Omit|null $browserName
     * @param BrowserVersionShape|Omit|null $browserVersion
     * @param Omit|Continent|value-of<Continent>|null $continent
     * @param DeviceFamilyShape|Omit|null $deviceFamily
     * @param DeviceTypeShape|Omit|null $deviceType
     * @param LanguageShape|Omit|null $language
     * @param LanguagePrefixShape|Omit|null $languagePrefix
     * @param OsNameShape|Omit|null $osName
     * @param OsVersionShape|Omit|null $osVersion
     * @param PixelRatioShape|Omit|null $pixelRatio
     * @param ScreenHeightPxShape|Omit|null $screenHeightPx
     * @param ScreenWidthPxShape|Omit|null $screenWidthPx
     * @param TimezoneShape|Omit|null $timezone
     * @param TimezoneOffsetMinutesShape|Omit|null $timezoneOffsetMinutes
     * @param UserAgentShape|Omit|null $userAgent
     * @param ViewportHeightPxShape|Omit|null $viewportHeightPx
     * @param ViewportWidthPxShape|Omit|null $viewportWidthPx
     */
    public static function with(
        Omit|string|float|bool|null $browserName = Omit::Value,
        Omit|string|float|bool|null $browserVersion = Omit::Value,
        string|Omit|null $city = Omit::Value,
        Omit|Continent|string|null $continent = Omit::Value,
        string|Omit|null $country = Omit::Value,
        Omit|string|float|bool|null $deviceFamily = Omit::Value,
        Omit|string|float|bool|null $deviceType = Omit::Value,
        Omit|string|float|bool|null $language = Omit::Value,
        Omit|string|float|bool|null $languagePrefix = Omit::Value,
        Omit|string|float|bool|null $osName = Omit::Value,
        Omit|string|float|bool|null $osVersion = Omit::Value,
        string|Omit|null $pageOrigin = Omit::Value,
        string|Omit|null $pagePath = Omit::Value,
        Omit|string|float|bool|null $pixelRatio = Omit::Value,
        Omit|string|float|bool|null $screenHeightPx = Omit::Value,
        Omit|string|float|bool|null $screenWidthPx = Omit::Value,
        Omit|string|float|bool|null $timezone = Omit::Value,
        Omit|string|float|bool|null $timezoneOffsetMinutes = Omit::Value,
        Omit|string|float|bool|null $userAgent = Omit::Value,
        Omit|string|float|bool|null $viewportHeightPx = Omit::Value,
        Omit|string|float|bool|null $viewportWidthPx = Omit::Value,
    ): self {
        $self = new self;

        Omit::Value !== $browserName && $self['browserName'] = $browserName;
        Omit::Value !== $browserVersion && $self['browserVersion'] = $browserVersion;
        Omit::Value !== $city && $self['city'] = $city;
        Omit::Value !== $continent && $self['continent'] = $continent;
        Omit::Value !== $country && $self['country'] = $country;
        Omit::Value !== $deviceFamily && $self['deviceFamily'] = $deviceFamily;
        Omit::Value !== $deviceType && $self['deviceType'] = $deviceType;
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

    /**
     * Copied from browser_context.browser_name when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @param BrowserNameShape|null $browserName
     */
    public function withBrowserName(string|float|bool|null $browserName): self
    {
        $self = clone $this;
        $self['browserName'] = $browserName;

        return $self;
    }

    /**
     * Copied from browser_context.browser_version when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @param BrowserVersionShape|null $browserVersion
     */
    public function withBrowserVersion(
        string|float|bool|null $browserVersion
    ): self {
        $self = clone $this;
        $self['browserVersion'] = $browserVersion;

        return $self;
    }

    /**
     * Approximate city name in English from the local City MMDB lookup. Null when unknown. Location displays using the bundled DB-IP data must link to https://db-ip.com.
     */
    public function withCity(?string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * Continent code from the local City MMDB lookup: Africa, Antarctica, Asia, Europe, North America, Oceania or South America. Null when unknown.
     *
     * @param Continent|value-of<Continent>|null $continent
     */
    public function withContinent(Continent|string|null $continent): self
    {
        $self = clone $this;
        $self['continent'] = $continent;

        return $self;
    }

    /**
     * Country ISO 3166-1 alpha-2 code from the local City MMDB lookup. Null when unknown. The request IP is discarded.
     */
    public function withCountry(?string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * Copied from browser_context.device_family when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @param DeviceFamilyShape|null $deviceFamily
     */
    public function withDeviceFamily(string|float|bool|null $deviceFamily): self
    {
        $self = clone $this;
        $self['deviceFamily'] = $deviceFamily;

        return $self;
    }

    /**
     * Copied from browser_context.device_type when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @param DeviceTypeShape|null $deviceType
     */
    public function withDeviceType(string|float|bool|null $deviceType): self
    {
        $self = clone $this;
        $self['deviceType'] = $deviceType;

        return $self;
    }

    /**
     * Copied from browser_context.language when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @param LanguageShape|null $language
     */
    public function withLanguage(string|float|bool|null $language): self
    {
        $self = clone $this;
        $self['language'] = $language;

        return $self;
    }

    /**
     * Copied from browser_context.language_prefix when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @param LanguagePrefixShape|null $languagePrefix
     */
    public function withLanguagePrefix(
        string|float|bool|null $languagePrefix
    ): self {
        $self = clone $this;
        $self['languagePrefix'] = $languagePrefix;

        return $self;
    }

    /**
     * Copied from browser_context.os_name when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @param OsNameShape|null $osName
     */
    public function withOsName(string|float|bool|null $osName): self
    {
        $self = clone $this;
        $self['osName'] = $osName;

        return $self;
    }

    /**
     * Copied from browser_context.os_version when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @param OsVersionShape|null $osVersion
     */
    public function withOsVersion(string|float|bool|null $osVersion): self
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

    /**
     * Copied from browser_context.pixel_ratio when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @param PixelRatioShape|null $pixelRatio
     */
    public function withPixelRatio(string|float|bool|null $pixelRatio): self
    {
        $self = clone $this;
        $self['pixelRatio'] = $pixelRatio;

        return $self;
    }

    /**
     * Copied from browser_context.screen_height_px when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @param ScreenHeightPxShape|null $screenHeightPx
     */
    public function withScreenHeightPx(
        string|float|bool|null $screenHeightPx
    ): self {
        $self = clone $this;
        $self['screenHeightPx'] = $screenHeightPx;

        return $self;
    }

    /**
     * Copied from browser_context.screen_width_px when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @param ScreenWidthPxShape|null $screenWidthPx
     */
    public function withScreenWidthPx(
        string|float|bool|null $screenWidthPx
    ): self {
        $self = clone $this;
        $self['screenWidthPx'] = $screenWidthPx;

        return $self;
    }

    /**
     * Copied from browser_context.timezone when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @param TimezoneShape|null $timezone
     */
    public function withTimezone(string|float|bool|null $timezone): self
    {
        $self = clone $this;
        $self['timezone'] = $timezone;

        return $self;
    }

    /**
     * Copied from browser_context.timezone_offset_minutes when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @param TimezoneOffsetMinutesShape|null $timezoneOffsetMinutes
     */
    public function withTimezoneOffsetMinutes(
        string|float|bool|null $timezoneOffsetMinutes
    ): self {
        $self = clone $this;
        $self['timezoneOffsetMinutes'] = $timezoneOffsetMinutes;

        return $self;
    }

    /**
     * Copied from browser_context.user_agent when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @param UserAgentShape|null $userAgent
     */
    public function withUserAgent(string|float|bool|null $userAgent): self
    {
        $self = clone $this;
        $self['userAgent'] = $userAgent;

        return $self;
    }

    /**
     * Copied from browser_context.viewport_height_px when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @param ViewportHeightPxShape|null $viewportHeightPx
     */
    public function withViewportHeightPx(
        string|float|bool|null $viewportHeightPx
    ): self {
        $self = clone $this;
        $self['viewportHeightPx'] = $viewportHeightPx;

        return $self;
    }

    /**
     * Copied from browser_context.viewport_width_px when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
     *
     * @param ViewportWidthPxShape|null $viewportWidthPx
     */
    public function withViewportWidthPx(
        string|float|bool|null $viewportWidthPx
    ): self {
        $self = clone $this;
        $self['viewportWidthPx'] = $viewportWidthPx;

        return $self;
    }
}
