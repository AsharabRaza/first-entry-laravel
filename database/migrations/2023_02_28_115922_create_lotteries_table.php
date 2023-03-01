<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotteriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotteries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('title');
            $table->text('header_image')->nullable();
            $table->text('background_image')->nullable();
            $table->text('lottery_url');
            $table->integer('total_winners');
            $table->integer('allow_guest');
            $table->integer('is_winners_selected')->default('0');
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->dateTime('start_datetime_utc')->nullable();
            $table->dateTime('end_datetime_utc')->nullable();
            $table->dateTime('event_datetime');
            $table->text('description');
            $table->text('how_it_works');
            $table->text('terms_conditions');
            $table->text('form_customization')->nullable();
            $table->char('country_code');
            $table->char('timezone');
            $table->tinyInteger('status')->default('1')->comment('0=deactive, 1=active');
            $table->tinyInteger('queing_process')->default('1');
            $table->dateTime('scan_start_datetime')->nullable();
            $table->dateTime('scan_end_datetime')->nullable();
            $table->char('scanning_option');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lotteries');
    }
}
