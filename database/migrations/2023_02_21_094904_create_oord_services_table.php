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
        Schema::create('oord_services', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('room_id')->unsigned();
            $table->string('oord_type');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('notes');
            $table->bigInteger('created_by')->unsigned();
            $table->string('is_return')->default(0);
            $table->bigInteger('return_by')->unsigned();
            $table->date('return_date');
            $table->softDeletes();
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
        Schema::dropIfExists('oord_services');
    }
};
