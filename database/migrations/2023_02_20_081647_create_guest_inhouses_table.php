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
        Schema::create('guest_inhouses', function (Blueprint $table) {
            $table->id();
            $table->string('folio_no',100);
            $table->date('in_date');
            $table->date('out_date');
            $table->date('original_out_date');
            $table->integer('no_of_nights');
            $table->float('rm_rate');
            $table->float('taxes');
            $table->integer('no_of_pax');
            $table->text('hotel_note');
            $table->text('client_note');
            $table->string('way_of_payment',50);
             $table->bigInteger('profile_id')->unsigned();
             $table->bigInteger('company_id')->unsigned();
             $table->bigInteger('room_id')->unsigned();
             $table->bigInteger('room_type_id')->unsigned();
             $table->bigInteger('rate_code_id')->unsigned();
             $table->bigInteger('market_segment_id')->unsigned();
             $table->bigInteger('source_of_business_id')->unsigned();
             $table->bigInteger('meal_id')->unsigned();
             $table->bigInteger('created_by')->unsigned();
             $table->date('created_inhousGuest_at');
             $table->boolean('checked_out');
             $table->bigInteger('checkout_by')->unsigned();
             $table->date('checkout_at');
            $table->boolean('is_reservation')->default(0);
            $table->string('res_status');
            $table->boolean('is_group')->default(0);
            $table->string('group_code')->nullable();
            $table->boolean('is_dummy')->default(0);
            $table->boolean('Is_PM')->default(0);
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
        Schema::dropIfExists('guest_inhouses');
    }
};
