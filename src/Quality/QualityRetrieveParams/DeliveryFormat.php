<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Quality\QualityRetrieveParams;

/**
 * Delivery format on the first retained view start: hls for HLS streams, file for a single media file such as an MP4 rendition. Metrics use the first retained view start; raw events use each event's value. Views whose SDK did not report it do not match. connector_name is not a substitute: Safari plays HLS natively and reports html-media.
 */
enum DeliveryFormat: string
{
    case HLS = 'hls';

    case FILE = 'file';
}
