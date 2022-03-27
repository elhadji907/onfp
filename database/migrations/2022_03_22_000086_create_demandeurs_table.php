<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandeursTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'demandeurs';

    /**
     * Run the migrations.
     * @table demandeurs
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->char('uuid', 36);
            $table->string('cin', 200)->nullable();
            $table->string('numero_dossier', 200)->nullable();
            $table->string('statut', 45)->nullable();
            $table->string('items1', 200)->nullable();
            $table->string('items2', 200)->nullable();
            $table->timestamp('date1')->nullable();
            $table->string('file1', 200)->nullable();
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('items_id')->nullable();
            $table->unsignedInteger('types_demandes_id')->nullable();
            $table->unsignedInteger('courriers_id')->nullable();

            $table->index(["users_id"], 'fk_demandeurs_users1_idx');

            $table->index(["items_id"], 'fk_demandeurs_items1_idx');

            $table->index(["types_demandes_id"], 'fk_demandeurs_types_demandes1_idx');

            $table->index(["courriers_id"], 'fk_demandeurs_courriers1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('users_id', 'fk_demandeurs_users1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('items_id', 'fk_demandeurs_items1_idx')
                ->references('id')->on('items')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('types_demandes_id', 'fk_demandeurs_types_demandes1_idx')
                ->references('id')->on('types_demandes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('courriers_id', 'fk_demandeurs_courriers1_idx')
                ->references('id')->on('courriers')
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
