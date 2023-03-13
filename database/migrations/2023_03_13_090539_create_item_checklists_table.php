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
        Schema::create('item_checklists', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->bigInteger('checklists_id')->unsigned();
            $table->foreign('checklists_id')
                ->references('id')
                ->on('checklists')
                ->onDelete('cascade');
            $table->boolean('implementation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_checklists');
    }
};
