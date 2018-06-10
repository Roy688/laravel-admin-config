<?php

namespace Roy688\Config;

use Illuminate\Database\Eloquent\Model;

class ConfigCategoryModel extends Model
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
        $this->setTable(config('admin.extensions.config_category.table', 'admin_config_category'));
    }

    /**
     * config_model
     * @return \Roy688\Config\ConfigModel
     */
    public function config_model()
    {
        return $this->belongsTo('Roy688\Config\ConfigModel');
    }

}
