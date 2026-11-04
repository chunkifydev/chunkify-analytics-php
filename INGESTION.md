# Event ingestion

Pass a typed event model to `events->ingest()`. Given a complete array of SDK field values for a view-started event:

```php
use ChunkifyAnalytics\Events\ViewStarted;

$event = ViewStarted::fromArray($eventFields);
$result = $client->events->ingest(event: $event);
```

`$eventFields` must contain all required fields using the generated PHP names, such as `eventID`, `videoID`, and `sdkName`. Use `DateTimeInterface` values for timestamp fields such as `occurredAt`. `fromArray()` does not validate completeness. Use `ViewStarted::with(...)` when you want PHP to require each mandatory argument. Use the corresponding model for each other event variant.

Explicit `null` is preserved for schema-declared nullable fields. Omitting an optional field leaves it absent. Required nullable fields must still be supplied, even when their value is `null`.

Direct associative arrays passed as the event remain unreliable. The PHP generator cannot consistently select the correct event variant and map its field names. This also affects `events->raw->ingest(['event' => $fields])`. Use a typed model for either entry point. The nullable-value generator fix addresses null preservation; it does not fix array variant selection.

