<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtablissementsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'etablissements';

    /**
     * Run the migrations.
     * @table etablissements
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->char('uuid', 36);
            $table->string('matricule', 200)->nullable();
            $table->string('name', 200);
            $table->string('sigle', 45)->nullable();
            $table->string('items1', 200)->nullable();
            $table->timestamp('date1')->nullable();
            $table->string('telephone1', 200)->nullable();
            $table->string('telephone2', 200)->nullable();
            $table->string('fixe', 200)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('adresse', 200)->nullable();
            $table->unsignedInteger('communes_id')->nullable();
            $table->unsignedInteger('filieres_id')->nullable();

            $table->index(["communes_id"], 'fk_etablissements_communes1_idx');

            $table->index(["filieres_id"], 'fk_etablissements_filieres1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('communes_id', 'fk_etablissements_communes1_idx')
                ->references('id')->on('communes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('filieres_id', 'fk_etablissements_filieres1_idx')
                ->references('id')->on('filieres')
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
