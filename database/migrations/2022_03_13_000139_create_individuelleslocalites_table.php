<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividuelleslocalitesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'individuelleslocalites';

    /**
     * Run the migrations.
     * @table individuelleslocalites
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('individuelles_id');
            $table->unsignedInteger('localites_id');

            $table->index(["localites_id"], 'fk_individuelles_has_localites_localites1_idx');

            $table->index(["individuelles_id"], 'fk_individuelles_has_localites_individuelles1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('individuelles_id', 'fk_individuelles_has_localites_individuelles1_idx')
                ->references('id')->on('individuelles')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('localites_id', 'fk_individuelles_has_localites_localites1_idx')
                ->references('id')->on('localites')
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
