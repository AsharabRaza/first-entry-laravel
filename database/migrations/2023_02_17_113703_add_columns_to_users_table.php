<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('user_type')->comment('1:User, 2:Agent')->after('id');
            $table->integer('otp')->nullable()->after('password');
            $table->text('profile_picture')->nullable()->after('otp');
            $table->text('phone')->nullable()->after('profile_picture');
            $table->text('company_name')->nullable()->after('phone');
            $table->text('company_size')->nullable()->after('company_name');
            $table->text('about_projects')->nullable()->after('company_size');
            $table->text('website')->nullable()->after('about_projects');
            $table->text('features_functions')->nullable()->after('website');
            $table->text('custom_features_functions')->nullable()->after('features_functions');
            $table->tinyInteger('paid_memberships')->default('0')->after('custom_features_functions');
            $table->tinyInteger('in_review')->nullable()->after('paid_memberships');
            $table->tinyInteger('review_approves')->nullable()->after('in_review');
            $table->tinyInteger('review_msg_seen')->default('0')->after('review_approves');
            $table->tinyInteger('email_confirm')->default('0')->after('review_msg_seen');
            $table->text('verify_key')->nullable()->after('email_confirm');
            $table->integer('trial_days')->nullable()->after('verify_key');
            $table->text('permissions')->nullable()->after('trial_days');
            $table->integer('created_by')->nullable()->after('permissions');
            $table->dateTime('last_login')->nullable()->after('created_by');
            $table->dateTime('last_updated')->nullable()->after('last_login');
            $table->dateTime('date_joined')->nullable()->after('last_updated');
            $table->date('start_date')->nullable()->after('date_joined');
            $table->date('end_date')->nullable()->after('start_date');
            $table->tinyInteger('email_limit')->default('0')->after('end_date');
            $table->tinyInteger('event_limit')->default('0')->after('password')->after('email_limit');
            $table->tinyInteger('login_event')->default('1')->comment('1:lottery, 2:movie')->after('event_limit');
            $table->tinyInteger('status')->after('login_event');
            $table->string('country')->after('status');
            $table->string('user_usage')->nullable()->after('country');
            $table->tinyInteger('is_admin')->default('0')->after('user_usage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'user_type','otp','profile_picture','phone','company_name',
                'company_size','about_projects','website','features_functions','custom_features_functions','paid_memberships','in_review',
                'review_approves','review_msg_seen','email_confirm','verify_key','trial_days','permissions','created_by','last_login','last_updated',
                'date_joined','start_date','end_date','email_limit','event_limit','login_event','status','country','user_usage','is_admin'
            ]);
        });
    }
}
