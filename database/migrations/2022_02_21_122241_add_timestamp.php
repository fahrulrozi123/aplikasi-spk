<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimestamp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('allotment', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('amenities', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('bed_type', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('customer', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('function_room', function (Blueprint $table) {
            $table->integer('func_publish_status')->default('1');
            $table->timestamps();
        });

        Schema::table('function_room_photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::table('inquiry', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('inquiry_other_request', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::table('master_other_request', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('page_photo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::table('payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::table('product', function (Blueprint $table) {
            $table->integer('product_publish_status')->default('1');
            $table->timestamps();
        });

        Schema::table('product_photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::table('product_rsvp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::table('room_amenities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::table('room_bed', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::table('room_photo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::table('room_rsvp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::table('room_type', function (Blueprint $table) {
            $table->integer('room_publish_status')->default('1');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('visitor_banner', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('visitor_news', function (Blueprint $table) {
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
        //
    }
}
