<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperateursregionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'operateursregions';

    /**
     * Run the migrations.
     * @table operateursregions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('operateurs_id');
            $table->unsignedInteger('regions_id');

            $table->index(["regions_id"], 'fk_operateurs_has_regions_regions1_idx');

            $table->index(["operateurs_id"], 'fk_operateurs_has_regions_operateurs1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('operateurs_id', 'fk_operateurs_has_regions_operateurs1_idx')
                ->references('id')->on('operateurs')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('regions_id', 'fk_operateurs_has_regions_regions1_idx')
                ->references('id')->on('regions')
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
