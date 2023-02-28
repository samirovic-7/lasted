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
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('company_code');
            $table->string('company_name');
            $table->string('company_name_loc');
            $table->foreignId('country_id')->constrained()->cascadeOnDelete();
            $table->string('city');
            $table->text('address');
            $table->string('phone_1');
            $table->string('phone_2');
            $table->string('mobile');
            $table->string('fax');
            $table->string('email');
            $table->string('p_o_box');
            $table->string('zip_number');
            $table->string('tax_no');
            $table->string('contact_person');
            $table->string('position');
            $table->string('contact_phone');
            $table->string('contact_mobile');
            $table->double('max_credit_limit');
            $table->string('current_balance');
            $table->string('def_rate_code')->nullable();
            $table->boolean('active')->default(true);






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
        Schema::dropIfExists('company_profiles');
    }
};
