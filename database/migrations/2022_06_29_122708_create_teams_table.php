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
        Schema::create('teams', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->id();
            $table->foreignId('agency_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('team_name');
            $table->string('contact_person');
            $table->string('mobile');
            $table->string('email');
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
            $table->dropForeign('tag_areas_team_id_foreign');
            $table->dropColumn('team_id');
        });

        Schema::dropIfExists('teams');
    }
};
