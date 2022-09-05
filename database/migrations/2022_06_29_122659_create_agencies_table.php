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
        Schema::create('agencies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->id();
            $table->string('agency_name');
            $table->string('contact_person');
            $table->string('mobile');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->boolean('active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tag_areas', function (Blueprint $table) {
            $table->dropForeign('tag_areas_agency_id_foreign');
            $table->dropColumn('agency_id');
        });

        Schema::dropIfExists('agencies');
    }
};
