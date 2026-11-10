<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Engagement\EngagementRetrieveParams;

/**
 * Optional on summary, quality and engagement. Group views by this field on their first retained start. Missing, null and nonstring context forms a null group; the literal device type unknown stays separate. Groups sort by views descending, then value ascending with null first for ties. Pagination is available only with group_by. Location uses the first retained start too. City groups use the stored name; filter by country to avoid combining names shared by different countries. Page groups use the first retained start even if playback continues after navigation. Filter by page_origin when grouping page_path to distinguish identical paths on different sites. video_title groups by the title on each view's first retained start, so a renamed video counts each view under the title it started with. user_id groups by the user ID on each view's first retained start. Use custom.<key>, such as custom.plan, to group by a custom dimension; views without the key form the null group.
 */
enum GroupBy: string
{
    case BROWSER_NAME = 'browser_name';

    case OS_NAME = 'os_name';

    case DEVICE_TYPE = 'device_type';

    case CONTINENT = 'continent';

    case COUNTRY = 'country';

    case CITY = 'city';

    case PAGE_ORIGIN = 'page_origin';

    case PAGE_PATH = 'page_path';

    case SUBTITLE_LANGUAGE = 'subtitle_language';

    case PLAYBACK_RATE = 'playback_rate';

    case VIDEO_TITLE = 'video_title';

    case USER_ID = 'user_id';
}
