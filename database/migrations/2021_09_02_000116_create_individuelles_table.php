<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividuellesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'individuelles';

    /**
     * Run the migrations.
     * @table individuelles
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->char('uuid', 36);
            $table->string('cin', 45)->nullable();
            $table->integer('nbre_pieces')->nullable();
            $table->longText('legende')->nullable();
            $table->longText('reference')->nullable();
            $table->longText('experience')->nullable();
            $table->longText('projet')->nullable();
            $table->longText('prerequis')->nullable();
            $table->longText('information')->nullable();
            $table->timestamp('date_depot')->nullable();
            $table->double('note')->nullable();
            $table->string('items1', 200)->nullable();
            $table->timestamp('date1')->nullable();
            $table->string('statut', 45)->nullable();
            $table->string('type', 45)->nullable();
            $table->unsignedInteger('demandeurs_id');
            $table->unsignedInteger('formations_id')->nullable();
            $table->unsignedInteger('communes_id')->nullable();

            $table->index(["demandeurs_id"], 'fk_individuelles_demandeurs1_idx');

            $table->index(["formations_id"], 'fk_individuelles_formations1_idx');

            $table->index(["communes_id"], 'fk_individuelles_communes1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('demandeurs_id', 'fk_individuelles_demandeurs1_idx')
                ->references('id')->on('demandeurs')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('formations_id', 'fk_individuelles_formations1_idx')
                ->references('id')->on('formations')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('communes_id', 'fk_individuelles_communes1_idx')
                ->references('id')->on('communes')
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
