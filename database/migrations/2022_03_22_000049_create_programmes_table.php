<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgrammesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'programmes';

    /**
     * Run the migrations.
     * @table programmes
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->char('uuid', 36);
            $table->string('name', 200);
            $table->string('sigle', 45)->nullable();
            $table->string('duree', 200)->nullable();
            $table->integer('effectif')->nullable();
            $table->unsignedInteger('ingenieurs_id')->nullable();

            $table->index(["ingenieurs_id"], 'fk_programmes_ingenieurs1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('ingenieurs_id', 'fk_programmes_ingenieurs1_idx')
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
