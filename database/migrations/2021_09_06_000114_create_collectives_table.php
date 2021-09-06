<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectivesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'collectives';

    /**
     * Run the migrations.
     * @table collectives
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->char('uuid', 36);
            $table->longText('name')->nullable();
            $table->timestamp('date_depot')->nullable();
            $table->string('items1', 200)->nullable();
            $table->timestamp('date1')->nullable();
            $table->string('sigle', 100)->nullable();
            $table->string('statut', 100)->nullable();
            $table->longText('description')->nullable();
            $table->string('type', 45)->nullable();
            $table->unsignedInteger('demandeurs_id');
            $table->unsignedInteger('ingenieurs_id')->nullable();
            $table->unsignedInteger('formations_id')->nullable();
            $table->unsignedInteger('communes_id')->nullable();
            $table->unsignedInteger('etudes_id')->nullable();

            $table->index(["demandeurs_id"], 'fk_collectives_demandeurs1_idx');

            $table->index(["ingenieurs_id"], 'fk_collectives_ingenieurs1_idx');

            $table->index(["formations_id"], 'fk_collectives_formations1_idx');

            $table->index(["communes_id"], 'fk_collectives_communes1_idx');

            $table->index(["etudes_id"], 'fk_collectives_etudes1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('demandeurs_id', 'fk_collectives_demandeurs1_idx')
                ->references('id')->on('demandeurs')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('ingenieurs_id', 'fk_collectives_ingenieurs1_idx')
                ->references('id')->on('ingenieurs')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('formations_id', 'fk_collectives_formations1_idx')
                ->references('id')->on('formations')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('communes_id', 'fk_collectives_communes1_idx')
                ->references('id')->on('communes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('etudes_id', 'fk_collectives_etudes1_idx')
                ->references('id')->on('etudes')
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