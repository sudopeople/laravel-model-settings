<?php

return [
    // settings field
    'settings_field_name' => env('MODEL_SETTINGS_FIELD_NAME', 'settings'),
    'settings_persistent' => env('MODEL_SETTINGS_PERSISTENT', true),

    // settings table
    'settings_table_name' => env('MODEL_SETTINGS_TABLE_NAME', 'model_settings'),
    'settings_table_use_cache' => env('MODEL_SETTINGS_TABLE_USE_CACHE', true),
    'settings_table_cache_prefix' => env('MODEL_SETTINGS_TABLE_CACHE_PREFIX', 'model_settings:'),

    // default settings table
    'settings_use_defaults_table' => env('MODEL_SETTINGS_USE_DEFAULTS_TABLE', false),
    'settings_defaults_table_name' => env('MODEL_SETTINGS_DEFAULTS_TABLE_NAME', 'model_settings_defaults'),
    'settings_defaults_table_use_cache' => env('MODEL_SETTINGS_DEFAULTS_TABLE_USE_CACHE', true),
    'settings_defaults_table_cache_ttl' => env('MODEL_SETTINGS_DEFAULTS_TABLE_TTL', '1 day'),
    'settings_defaults_table_cache_prefix' => env('MODEL_SETTINGS_DEFAULTS_TABLE_CACHE_PREFIX', 'model_settings_defaults:'),

    // defaults
    'defaultSettings' => [
        'users' => [

        ]
    ]
];
