<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_recieved_note_items', function (Blueprint $table) {
            $table->id();
            $table->integer('note_id');
            $table->string('thai_number');
            $table->string('container_number');
            $table->string('packing');
            $table->integer('kg')->default(0);
            $table->integer('container_qty')->default(0);
            $table->integer('recieved_qty')->default(0);
            $table->text('item_description');
            $table->integer('checkpoint')->default(0);
            $table->text('remark');
            $table->text('image')->nullable();
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
        Schema::dropIfExists('good_recieved_note_items');
    }
};
