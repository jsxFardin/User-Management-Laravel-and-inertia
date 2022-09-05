<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        // Schema::table('user_activity_logs', function (Blueprint $table) {
        //     $table->enum('event', ['created', 'updated', 'deleted', 'login', 'logout'])->change();
        // });
        DB::statement("ALTER TABLE `user_activity_logs` CHANGE `event` `event` ENUM('created', 'updated', 'deleted', 'login', 'logout')");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_activity_logs', function (Blueprint $table) {
            //
        });
    }
};
