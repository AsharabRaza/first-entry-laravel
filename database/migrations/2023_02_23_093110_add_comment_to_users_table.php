<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('status')->comment('0:Users(CreatedByAdmin), 1:InReviewUsers, 2:PaidMembers')->change();
            //$table->comment('User status: 0=Users(CreatedByAdmin), 1=InReviewUsers, 2=PaidMembers')->change();
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
            $table->string('status')->comment(null)->change();
        });
    }
}
