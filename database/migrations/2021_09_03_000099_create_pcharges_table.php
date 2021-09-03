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
            $table->string('cin', 45)->nullable();
            $table->integer('annee')->nullable();
            $table->string('matricule', 45)->nullable();
            $table->string('typedemande', 200)->nullable();
            $table->string('items1', 200)->nullable();
            $table->timestamp('date1')->nullable();
            $table->timestamp('date_depot')->nullable();
            $table->double('inscription')->nullable();
            $table->double('montant')->nullable();
            $table->double('accompt')->nullable();
            $table->double('reliquat')->nullable();
            $table->integer('duree')->nullable();
            $table->string('niveauentree', 200)->nullable();
            $table->string('niveausortie', 45)->nullable();
            $table->string('specialisation', 200)->nullable();
            $table->string('statut', 45)->nullable();
            $table->string('file1', 200)->nullable();
            $table->string('file2', 200)->nullable();
            $table->string('file3', 200)->nullable();
            $table->string('file4', 200)->nullable();
            $table->string('file5', 200)->nullable();
            $table->string('file6', 200)->nullable();
            $table->string('file7', 200)->nullable();
            $table->string('file8', 200)->nullable();
            $table->unsignedInteger('demandeurs_id')->nullable();
            $table->unsignedInteger('etablissements_id')->nullable();
            $table->unsignedInteger('filieres_id')->nullable();
            $table->unsignedInteger('communes_id')->nullable();
            $table->unsignedInteger('scolarites_id')->nullable();
            $table->string('avis_dg', 45)->nullable();

            $table->index(["demandeurs_id"], 'fk_charge_demandeurs1_idx');

            $table->index(["etablissements_id"], 'fk_pcharges_etablissements1_idx');

            $table->index(["filieres_id"], 'fk_pcharges_filieres1_idx');

            $table->index(["communes_id"], 'fk_pcharges_communes1_idx');

            $table->index(["scolarites_id"], 'fk_pcharges_scolarites1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('demandeurs_id', 'fk_charge_demandeurs1_idx')
                ->references('id')->on('demandeurs')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('etablissements_id', 'fk_pcharges_etablissements1_idx')
                ->references('id')->on('etablissements')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('filieres_id', 'fk_pcharges_filieres1_idx')
                ->references('id')->on('filieres')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('communes_id', 'fk_pcharges_communes1_idx')
                ->references('id')->on('communes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('scolarites_id', 'fk_pcharges_scolarites1_idx')
                ->references('id')->on('scolarites')
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
