<?php

namespace Glorand\Model\Settings\Traits;

use Glorand\Model\Settings\Contracts\SettingsManagerContract;
use Glorand\Model\Settings\Models\ModelSettingsDefaults;
use Illuminate\Support\Arr;

/**
 * @property array $settingsRules
 * @property array $defaultSettings
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
trait HasSettings
{
    public function getRules(): array
    {
        if (property_exists($this, 'settingsRules') && is_array($this->settingsRules)) {
            return $this->settingsRules;
        }

        return [];
    }

    public function getDefaultSettings(): array
    {
        if (config('model_settings.settings_use_defaults_table')) {
            if (config('model_settings.settings_defaults_table_use_cache')) {
                return Cache::remember(
                    $this->getSettingsDefaultsTableCacheKey(),
                    now()->add(config('model_settings.settings_defaults_table_cache_ttl')),
                    function () {
                        return $this->__getSettingsDefaultsTableValue();
                    }
                );
            }

            return $this->__getSettingsDefaultsTableValue();
        }

        if (property_exists($this, 'defaultSettings')) {
            if (is_array($this->defaultSettings)) {
                return Arr::wrap($this->defaultSettings);
            }
        }

        if ($defaultSettings = config('model_settings.defaultSettings.' . $this->getTable())) {
            if (is_array($defaultSettings)) {
                return Arr::wrap($defaultSettings);
            }
        }

        return [];
    }

    public function getSettingsDefaultsTableCacheKey(): string
    {
        return config('model_settings.settings_defaults_table_cache_prefix') . $this->getTable();
    }

    private function __getSettingsDefaultsTableValue(): array
    {
        if ($modelSettingsDefaults = ModelSettingsDefaults::where('model_type', $this->getTable())->first()) {
            if ($modelSettingsDefaults instanceof ModelSettingsDefaults) {
                if (is_array($modelSettingsDefaults->settings)) {
                    return Arr::wrap($modelSettingsDefaults->settings);
                }
            }
        }

        return [];
    }

    public function __call($name, $args)
    {
        if (isset($this->invokeSettingsBy) && $name === $this->invokeSettingsBy) {
            return $this->settings();
        }

        return call_user_func(get_parent_class($this) . '::__call', $name, $args);
    }

    abstract public function getSettingsValue(): array;

    abstract public function settings(): SettingsManagerContract;
}
