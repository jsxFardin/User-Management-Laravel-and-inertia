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
        Schema::create('blocks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->id();
            $table->foreignId('camp_id')->constrained('camps')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('blocks')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->decimal('longitude', 10, 7);
            $table->decimal('latitude', 10, 7);
            $table->decimal('area', 10, 2)->nullable()->comment('Area of square kilometers');
            $table->decimal('number_of_family', 10, 2)->nullable();
            $table->decimal('number_of_house', 10, 2)->nullable();
            $table->decimal('population', 10, 2)->nullable()->comment('Residents per square kilometer');
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
        Schema::dropIfExists('blocks');
    }
};
