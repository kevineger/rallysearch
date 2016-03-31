<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->unique();
            $table->string('mid')->unique();
        });

        // Pivot table between annotations and labels
        Schema::create('annotation_label', function (Blueprint $table) {
            $table->integer('annotation_id')->unsigned()->index();
            $table->integer('label_id')->unsigned()->index();

            $table->foreign('annotation_id')
                ->references('id')
                ->on('annotations')
                ->onDelete('cascade');

            $table->foreign('label_id')
                ->references('id')
                ->on('labels')
                ->onDelete('cascade');

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
        Schema::drop('annotation_label');
        Schema::drop('labels');
    }
}
