<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lottery_id')->constrained('lotteries');
            $table->string('uid')->nullable();
            $table->text('qr_code')->nullable();
            $table->text('first_name');
            $table->text('last_name');
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->integer('confirm_mail')->default('0');
            $table->integer('guest_id')->default('0');
            $table->integer('has_parent')->default('0');
            $table->integer('terms_conditions_agree')->default('0');
            $table->text('custom_inputs_val')->nullable();
            $table->integer('entry_confirmed')->default('0');
            $table->integer('entry_confirmed_by')->nullable();
            $table->string('entry_confirmed_by_type')->nullable();
            $table->string('entry_confirmed_by_type_nicename')->nullable();
            $table->dateTime('entry_confirmed_datetime')->nullable();
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
        Schema::dropIfExists('entries');
    }
}
