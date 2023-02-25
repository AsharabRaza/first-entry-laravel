<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipsInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships_infos', function (Blueprint $table) {
            $table->id();
            $table->string('membership_type')->nullable();
            $table->text('membership_nicename');
            $table->double('cost', 8, 2);
            $table->double('monthly')->default(false);
            $table->double('yearly_monthly')->default(false);
            $table->double('total_yearly', 8, 2)->nullable();
            $table->integer('manage_event')->default(false);
            $table->string('events')->nullable();
            $table->string('event_analytics')->nullable();
            $table->string('embed_form_link')->nullable();
            $table->string('custom_field')->nullable();
            $table->string('customize_online_forms')->nullable();
            $table->string('amount_of_entries')->nullable();
            $table->string('amount_of_emails')->nullable();
            $table->string('emails_analytics')->nullable();
            $table->string('first_entry_uid')->nullable();
            $table->text('qr_scanning')->nullable();
            $table->text('barcode_scanning')->nullable();
            $table->string('addons')->nullable();
            $table->string('sms_notification')->nullable();
            $table->timestamp('last_updated')->nullable();
            $table->timestamp('date_created')->nullable();
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
        Schema::dropIfExists('memberships_infos');
    }
}
