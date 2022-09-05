<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::table('latrines', function (Blueprint $table) {
            $table->boolean('pwsn')->default(0)->comment('0=No, 1=Yes');
            $table->unsignedBigInteger('sub_block_id')->after('block_id')->nullable();
        });

        Schema::dropIfExists('pwsns');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('latrines', function (Blueprint $table) {
            //
        });
    }
};
