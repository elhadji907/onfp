<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividuellesmodulesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'individuellesmodules';

    /**
     * Run the migrations.
     * @table individuellesmodules
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('individuelles_id');
            $table->unsignedInteger('modules_id');
            $table->unsignedInteger('individuellemodulestatut_id')->nullable();

            $table->index(["modules_id"], 'fk_individuelles_has_modules_modules1_idx');

            $table->index(["individuelles_id"], 'fk_individuelles_has_modules_individuelles1_idx');

            $table->index(["individuellemodulestatut_id"], 'fk_individuellesmodules_individuellemodulestatut1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('individuelles_id', 'fk_individuelles_has_modules_individuelles1_idx')
                ->references('id')->on('individuelles')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('modules_id', 'fk_individuelles_has_modules_modules1_idx')
                ->references('id')->on('modules')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('individuellemodulestatut_id', 'fk_individuellesmodules_individuellemodulestatut1_idx')
                ->references('id')->on('individuellemodulestatut')
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
