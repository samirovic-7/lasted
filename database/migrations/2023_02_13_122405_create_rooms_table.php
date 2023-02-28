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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('rm_name_en');
            $table->string('rm_name_loc')->nullable();
            $table->tinyInteger('rm_max_pax')->nullable();
            $table->string('rm_phone_no')->nullable();
            $table->string('rm_phone_ext')->nullable();
            $table->string('rm_key_code')->nullable();
            $table->string('rm_key_options')->nullable();
            $table->boolean('rm_connection')->default(0);
            $table->string('fo_status')->default('va');
            $table->string('hk_stauts')->default('cl');
            $table->string('rm_active')->default(1);
            $table->integer('sort_order');
            $table->bigInteger('room_type_id')->unsigned();
            $table->bigInteger('floor_id')->unsigned();
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
        Schema::dropIfExists('rooms');
    }
};
