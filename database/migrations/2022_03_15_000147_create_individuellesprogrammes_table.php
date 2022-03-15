<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividuellesprogrammesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'individuellesprogrammes';

    /**
     * Run the migrations.
     * @table individuellesprogrammes
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('individuelles_id');
            $table->unsignedInteger('programmes_id');

            $table->index(["programmes_id"], 'fk_individuelles_has_programmes_programmes1_idx');

            $table->index(["individuelles_id"], 'fk_individuelles_has_programmes_individuelles1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('individuelles_id', 'fk_individuelles_has_programmes_individuelles1_idx')
                ->references('id')->on('individuelles')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('programmes_id', 'fk_individuelles_has_programmes_programmes1_idx')
                ->references('id')->on('programmes')
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
