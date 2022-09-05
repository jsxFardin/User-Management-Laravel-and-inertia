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
        Schema::table('desludges', function (Blueprint $table) {
            $table->foreignId('user_id')->after('sludge_transfer_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('desludges', function (Blueprint $table) {
            $table->dropForeign('desludges_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
};
