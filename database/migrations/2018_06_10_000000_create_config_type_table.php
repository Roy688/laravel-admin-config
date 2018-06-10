<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        $table = config('admin.extensions.config_type.table', 'admin_config_type');

        Schema::connection($connection)->create($table, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->integer('order');

            $table->string('name')->unique();
            $table->string('title');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        $table = config('admin.extensions.config_type.table', 'admin_config_type');

        Schema::connection($connection)->dropIfExists($table);
    }
}
