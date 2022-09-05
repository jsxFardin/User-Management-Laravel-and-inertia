<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

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
            $table->dropColumn('longitude');
            $table->dropColumn('latitude');
            $table->dropColumn('sludge_transferred_to');
            $table->foreignId('pit_type_id')->after('latrine_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('sludge_transfer_id')->after('pit_type_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->decimal('count_desludge_ring', 10, 2)->nullable()->change();
            $table->decimal('desludged_height_from_top', 10, 2)->nullable()->change();
            $table->decimal('total_volume_desludged', 10, 2)->change();
            $table->decimal('litre_of_petrol', 10, 2)->change();

            $table->decimal('dia_of_ring', 10, 2)->after('sludge_transfer_id')->nullable();
            $table->decimal('dimension_of_septic_tank', 10, 2)->after('count_desludge_ring')->nullable();
            $table->decimal('ring_left_behind', 10, 2)->after('see_foreign_materials')->default(0)->comment('How many ring is left behind in the pit');
            $table->string('septic_tank_id_ts_number')->after('ring_left_behind')->nullable()->comment('Mention septic tank ID TS number');
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
