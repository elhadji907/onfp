<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePchargesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'pcharges';

    /**
     * Run the migrations.
     * @table pcharges
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->char('uuid', 36);
            $table->string('cin', 200);
            $table->string('items1', 200)->nullable();
            $table->timestamp('date1')->nullable();
            $table->integer('duree')->nullable();
            $table->double('accompt')->nullable();
            $table->double('reliquat')->nullable();
            $table->unsignedInteger('demandeurs_id')->nullable();
            $table->unsignedInteger('ecoles_id')->nullable();
            $table->integer('annee')->nullable();
            $table->string('file1', 200)->nullable();
            $table->string('file2', 200)->nullable();
            $table->string('file3', 200)->nullable();
            $table->string('file4', 200)->nullable();
            $table->string('file5', 200)->nullable();
            $table->string('file6', 200)->nullable();
            $table->string('file7', 200)->nullable();
            $table->string('file8', 200)->nullable();

            $table->index(["demandeurs_id"], 'fk_charge_demandeurs1_idx');

            $table->index(["ecoles_id"], 'fk_charge_ecoles1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('demandeurs_id', 'fk_charge_demandeurs1_idx')
                ->references('id')->on('demandeurs')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('ecoles_id', 'fk_charge_ecoles1_idx')
                ->references('id')->on('etablissements')
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
