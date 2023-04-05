<?php

namespace Glorand\Model\Settings\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ModelSettingsDefaults
 * @package Glorand\Model\Settings\Models
 * @property array $settings
 */
class ModelSettingsDefaults extends Model
{
    /**
     * ModelSettings constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('model_settings.settings_defaults_table_name', 'model_settings_defaults'));
    }

    protected $casts = [
        'settings' => 'json',
    ];
}
