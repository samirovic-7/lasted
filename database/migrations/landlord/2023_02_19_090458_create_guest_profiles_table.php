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
        Schema::create('guest_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('Profile_no')->unique();
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('id_no',100)->unique();
            $table->string('mobile',50);
            $table->string('phone',50);
            $table->string('email',100)->unique();
            $table->string('address');
            $table->bigInteger('country_id')->unsigned();
            $table->string('city');
            $table->string('language');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('created_by');
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
        Schema::dropIfExists('guest_profiles');
    }
};
