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
        Schema::table('agencies', function (Blueprint $table) {
            $table->dropForeign('agencies_camp_id_foreign');
            $table->dropColumn('camp_id');
        });

        Schema::table('teams', function (Blueprint $table) {
            $table->dropForeign('teams_block_id_foreign');
            $table->dropColumn('block_id');
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
};
