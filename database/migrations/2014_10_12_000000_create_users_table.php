<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_type');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('otp')->nullable();
            $table->text('profile_picture')->nullable();
            $table->text('phone')->nullable();
            $table->text('company_name')->nullable();
            $table->text('company_size')->nullable();
            $table->text('about_projects')->nullable();
            $table->text('website')->nullable();
            $table->text('features_functions')->nullable();
            $table->text('custom_features_functions')->nullable();
            $table->tinyInteger('paid_memberships')->default('0');
            $table->tinyInteger('in_review')->nullable();
            $table->tinyInteger('review_approves')->nullable();
            $table->tinyInteger('review_msg_seen')->default('0');
            $table->tinyInteger('email_confirm')->default('0');
            $table->text('verify_key')->nullable();
            $table->integer('trial_days')->nullable();
            $table->text('permissions')->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->dateTime('last_updated')->nullable();
            $table->dateTime('date_joined')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->tinyInteger('email_limit')->default('0');
            $table->tinyInteger('event_limit')->default('0');
            $table->tinyInteger('login_event')->default('1')->comment('1:lottery, 2:movie');
            $table->tinyInteger('status');
            $table->char('status');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
