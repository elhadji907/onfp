<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesagrementsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'modulesagrements';

    /**
     * Run the migrations.
     * @table modulesagrements
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('modules_id');
            $table->unsignedInteger('agrements_id');

            $table->index(["agrements_id"], 'fk_modulesagrements_agrements1_idx');

            $table->index(["modules_id"], 'fk_modules_has_agrements_modules1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('modules_id', 'fk_modules_has_agrements_modules1_idx')
                ->references('id')->on('modules')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('agrements_id', 'fk_modules_has_agrements_agrements1_idx')
                ->references('id')->on('agrements')
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
