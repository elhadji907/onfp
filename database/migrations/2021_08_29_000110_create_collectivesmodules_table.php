<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectivesmodulesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'collectivesmodules';

    /**
     * Run the migrations.
     * @table collectivesmodules
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('collectives_id');
            $table->unsignedInteger('modules_id');

            $table->index(["modules_id"], 'fk_collectivesmodules_modules1_idx');

            $table->index(["collectives_id"], 'fk_collectivesmodules_collectives1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('collectives_id', 'fk_collectivesmodules_collectives1_idx')
                ->references('id')->on('collectives')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('modules_id', 'fk_collectivesmodules_modules1_idx')
                ->references('id')->on('modules')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
