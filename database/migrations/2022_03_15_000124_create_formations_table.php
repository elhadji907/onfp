<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormationsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'formations';

    /**
     * Run the migrations.
     * @table formations
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->char('uuid', 36);
            $table->string('code', 200);
            $table->string('name', 200)->nullable();
            $table->string('qualifications', 200)->nullable();
            $table->string('effectif_total', 200)->nullable();
            $table->dateTime('date_pv')->nullable();
            $table->dateTime('date_debut')->nullable();
            $table->dateTime('date_fin')->nullable();
            $table->string('adresse', 200)->nullable();
            $table->integer('prevue_h')->nullable();
            $table->integer('prevue_f')->nullable();
            $table->string('titre', 200)->nullable();
            $table->string('attestation', 200)->nullable();
            $table->integer('forme_h')->nullable();
            $table->integer('forme_f')->nullable();
            $table->integer('total')->nullable();
            $table->string('lieu', 200)->nullable();
            $table->string('convention_col', 200)->nullable();
            $table->string('decret', 200)->nullable();
            $table->string('beneficiaires', 200)->nullable();
            $table->unsignedInteger('ingenieurs_id')->nullable();
            $table->unsignedInteger('agents_id')->nullable();
            $table->unsignedInteger('detfs_id')->nullable();
            $table->unsignedInteger('conventions_id')->nullable();
            $table->unsignedInteger('programmes_id')->nullable();
            $table->unsignedInteger('operateurs_id')->nullable();
            $table->unsignedInteger('traitements_id')->nullable();
            $table->unsignedInteger('niveauxs_id')->nullable();
            $table->unsignedInteger('specialites_id')->nullable();
            $table->unsignedInteger('courriers_id')->nullable();
            $table->unsignedInteger('statuts_id')->nullable();
            $table->unsignedInteger('types_formations_id')->nullable();
            $table->unsignedInteger('communes_id')->nullable();
            $table->unsignedInteger('antennes_id')->nullable();
            $table->unsignedInteger('projets_id')->nullable();
            $table->unsignedInteger('choixoperateurs_id')->nullable();
            $table->unsignedInteger('modules_id')->nullable();

            $table->index(["agents_id"], 'fk_consommations_agents1_idx');

            $table->index(["detfs_id"], 'fk_formations_detfs1_idx');

            $table->index(["conventions_id"], 'fk_formations_conventions1_idx');

            $table->index(["programmes_id"], 'fk_formations_programmes1_idx');

            $table->index(["operateurs_id"], 'fk_formations_operateurs1_idx');

            $table->index(["traitements_id"], 'fk_formations_traitements1_idx');

            $table->index(["ingenieurs_id"], 'fk_formations_ingenieurs1_idx');

            $table->index(["niveauxs_id"], 'fk_formations_niveauxs1_idx');

            $table->index(["specialites_id"], 'fk_formations_specialites1_idx');

            $table->index(["courriers_id"], 'fk_formations_courriers1_idx');

            $table->index(["statuts_id"], 'fk_formations_statuts1_idx');

            $table->index(["types_formations_id"], 'fk_formations_types_formations1_idx');

            $table->index(["communes_id"], 'fk_formations_communes1_idx');

            $table->index(["antennes_id"], 'fk_formations_antennes1_idx');

            $table->index(["projets_id"], 'fk_formations_projets1_idx');

            $table->index(["choixoperateurs_id"], 'fk_formations_choixoperateurs1_idx');

            $table->index(["modules_id"], 'fk_formations_modules1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('agents_id', 'fk_consommations_agents1_idx')
                ->references('id')->on('agents')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('detfs_id', 'fk_formations_detfs1_idx')
                ->references('id')->on('detfs')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('conventions_id', 'fk_formations_conventions1_idx')
                ->references('id')->on('conventions')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('programmes_id', 'fk_formations_programmes1_idx')
                ->references('id')->on('programmes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('operateurs_id', 'fk_formations_operateurs1_idx')
                ->references('id')->on('operateurs')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('traitements_id', 'fk_formations_traitements1_idx')
                ->references('id')->on('traitements')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('ingenieurs_id', 'fk_formations_ingenieurs1_idx')
                ->references('id')->on('ingenieurs')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('niveauxs_id', 'fk_formations_niveauxs1_idx')
                ->references('id')->on('niveauxs')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('specialites_id', 'fk_formations_specialites1_idx')
                ->references('id')->on('specialites')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('courriers_id', 'fk_formations_courriers1_idx')
                ->references('id')->on('courriers')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('statuts_id', 'fk_formations_statuts1_idx')
                ->references('id')->on('statuts')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('types_formations_id', 'fk_formations_types_formations1_idx')
                ->references('id')->on('types_formations')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('communes_id', 'fk_formations_communes1_idx')
                ->references('id')->on('communes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('antennes_id', 'fk_formations_antennes1_idx')
                ->references('id')->on('antennes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('projets_id', 'fk_formations_projets1_idx')
                ->references('id')->on('projets')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('choixoperateurs_id', 'fk_formations_choixoperateurs1_idx')
                ->references('id')->on('choixoperateurs')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('modules_id', 'fk_formations_modules1_idx')
                ->references('id')->on('modules')
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
