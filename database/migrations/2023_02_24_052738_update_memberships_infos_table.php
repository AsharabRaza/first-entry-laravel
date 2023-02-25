<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMembershipsInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('memberships_infos', function (Blueprint $table) {
            $table->decimal('cost')->nullable()->change();
            $table->decimal('monthly')->nullable()->change();
            $table->decimal('yearly_monthly')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('memberships_infos', function (Blueprint $table) {
            $table->decimal('cost')->change();
            $table->decimal('monthly')->change();
            $table->decimal('yearly_monthly')->change();
        });
    }
}
