<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividuelleszonesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'individuelleszones';

    /**
     * Run the migrations.
     * @table individuelleszones
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('individuelles_id');
            $table->unsignedInteger('zones_id');

            $table->index(["zones_id"], 'fk_individuelles_has_zones_zones1_idx');

            $table->index(["individuelles_id"], 'fk_individuelles_has_zones_individuelles1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('individuelles_id', 'fk_individuelles_has_zones_individuelles1_idx')
                ->references('id')->on('individuelles')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('zones_id', 'fk_individuelles_has_zones_zones1_idx')
                ->references('id')->on('zones')
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