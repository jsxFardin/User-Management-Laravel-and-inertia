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
            $table->foreignId('sanitation_zone_id')->nullable()->after('constructor_id')->constrained('sanitation_zones')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('total_chamber', 10, 2)->change();
            $table->decimal('total_ring_number', 10, 2)->change();
            $table->decimal('dia_of_ring', 10, 2)->change();
            $table->decimal('septic_tank_dimension', 10, 2)->change();
            $table->decimal('total_volume', 10, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('latrines', function (Blueprint $table) {
            $table->dropForeign('latrines_sanitation_zone_id_foreign');
            $table->dropColumn('sanitation_zone_id');

            $table->decimal('total_chamber', 10, 7)->change();
            $table->decimal('total_ring_number', 10, 7)->change();
            $table->decimal('dia_of_ring', 10, 7)->change();
            $table->decimal('septic_tank_dimension', 10, 7)->change();
            $table->decimal('total_volume', 10, 7)->change();
        });
    }
};
