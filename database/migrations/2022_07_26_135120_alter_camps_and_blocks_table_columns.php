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
        Schema::table('camps', function (Blueprint $table) {
            $table->char('short_name', 12)->after('id');
            $table->string('location')->nullable()->change();
            $table->decimal('longitude')->nullable()->change();
            $table->decimal('latitude')->nullable()->change();
        });

        Schema::table('blocks', function (Blueprint $table) {
            $table->char('short_name', 12)->after('parent_id');
            $table->decimal('longitude')->nullable()->change();
            $table->decimal('latitude')->nullable()->change();
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
