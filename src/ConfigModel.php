<?php

namespace Roy688\Config;

use Illuminate\Database\Eloquent\Model;

class ConfigModel extends Model
{
    /**
     * Settings constructor.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        parent::__construct($attributes);

        $this->setConnection(config('admin.database.connection') ?: config('database.default'));

        $this->setTable(config('admin.extensions.config.table', 'admin_config'));
    }
    
    /**
     * getTypeSelectOptions
     * 
     * @return array
     */
    public function getTypeSelectOptions()
    {
        return [
            'string', 'select', 'array', 'text', 'number', 'date', 'time', 'datetime', 'image', 'file', 'checkbox', 'radio',
        ];
    }

    /**
     * config_category_model
     * @return Roy688\Config\ConfigCategoryModel
     */
    public function config_category_model() {
        return $this->hasOne('Roy688\Config\ConfigCategoryModel');
    }

}
