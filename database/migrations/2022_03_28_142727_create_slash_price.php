<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlashPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room_rsvp', function (Blueprint $table) {
            $table->integer('rate_plan_id');
        });

        Schema::table('room_type', function (Blueprint $table) {
            $table->integer('def_allotment');

        });

        Schema::create('room_rate_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('room_id');
            $table->integer('rates_plan_id');
            $table->integer('room_future_availability');
            $table->integer('def_plans_rate');
            $table->integer('def_week_plans_rate');
            $table->integer('def_slash_plans_rate');
            $table->integer('def_extra_bed_rate');
            $table->timestamps();
        });

        Schema::table('allotment', function (Blueprint $table) {
            $table->integer('opened_qty');
            $table->integer('booked_qty');
            $table->integer('pending_qty');
        });

        Schema::create('allotment_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('availability_id');
            $table->integer('rates_plan_id');
            $table->integer('plan_status');
            $table->integer('publish_rate');
            $table->integer('slash_rate');
            $table->integer('extrabed_rate');
            $table->timestamps();
        });

        Schema::create('rates_plan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('rates_plan_policy', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('plan_id');
            $table->integer('policy_type');
            $table->string('policy_value');
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
        Schema::dropIfExists('slash_price');
    }
}
