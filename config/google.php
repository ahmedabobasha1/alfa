<?php

return [
    'search_console' => [
        // Absolute path to the service account JSON credentials file
        'key_file' => env('GOOGLE_SC_CREDENTIALS', storage_path('app/google-service-account.json')),

        // The exact property URL as it appears in Search Console (e.g., 'https://example.com/' or 'sc-domain:example.com')
        'site_url' => env('GOOGLE_SC_SITE_URL', null),

        // Optional: impersonate a user for domain-wide delegation (leave null for normal service account auth)
        'impersonate_user' => env('GOOGLE_SC_IMPERSONATE_USER', null),

        // Scopes used by the Search Console API
        'scopes' => [\Google\Service\SearchConsole::WEBMASTERS_READONLY],
    ],

    'analytics' => [
        // Absolute path to the service account JSON credentials file
        'key_file' => env('GOOGLE_ANALYTICS_CREDENTIALS', storage_path('app/google-analytics-service-account.json')),

        // Google Analytics 4 Property ID (e.g., '123456789')
        'property_id' => env('GOOGLE_ANALYTICS_PROPERTY_ID', null),

        // Default date range for analytics
        'start_date' => env('GOOGLE_ANALYTICS_START_DATE', '30daysAgo'),
        'end_date' => env('GOOGLE_ANALYTICS_END_DATE', 'today'),

        // Optional: impersonate a user for domain-wide delegation (leave null for normal service account auth)
        'impersonate_user' => env('GOOGLE_ANALYTICS_IMPERSONATE_USER', null),

        // Scopes used by the Google Analytics API
        'scopes' => ['https://www.googleapis.com/auth/analytics.readonly'],
    ],
];
