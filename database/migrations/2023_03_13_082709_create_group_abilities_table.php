<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_abilities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('usersgroup_id')->unsigned();
            $table->foreign('usersgroup_id')
                ->references('id')
                ->on('usersgroups')
                ->onDelete('cascade');
            $table->bigInteger('abilitygroup_id')->unsigned();
            $table->foreign('abilitygroup_id')
                ->references('id')
                ->on('ability_groups')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_abilities');
    }
};
