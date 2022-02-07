<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjetsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'projets';

    /**
     * Run the migrations.
     * @table projets
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->char('uuid', 36);
            $table->string('name', 200)->nullable();
            $table->string('sigle', 200)->nullable();
            $table->longText('description')->nullable();
            $table->timestamp('debut')->nullable();
            $table->dateTime('fin')->nullable();
            $table->double('budjet')->nullable();
            $table->longText('budjet_lettre')->nullable();
            $table->unsignedInteger('ingenieurs_id')->nullable();

            $table->index(["ingenieurs_id"], 'fk_projets_ingenieurs1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('ingenieurs_id', 'fk_projets_ingenieurs1_idx')
                ->references('id')->on('ingenieurs')
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
