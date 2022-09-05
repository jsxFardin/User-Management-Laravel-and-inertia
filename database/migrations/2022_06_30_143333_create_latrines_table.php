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
        Schema::create('latrines', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->id();
            $table->string('uid_no');
            $table->foreignId('camp_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('block_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('facility_type_id')->constrained('facility_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('facility_used_id')->constrained('facility_useds')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('construction_status_id')->constrained('construction_status')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('latrine_structure_id')->constrained('latrine_structures')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('pit_type_id')->constrained('pit_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('constructor_id')->nullable()->constrained('donors')->onUpdate('cascade')->onDelete('cascade');
            $table->char('chamber_door', 4)->default(0);
            $table->char('male_number_stickers', 4)->default(0);
            $table->char('male_number_user', 4)->default(0);
            $table->char('female_number_stickers', 4)->default(0);
            $table->char('female_number_user', 4)->default(0);
            $table->char('children_number', 4)->default(0);
            $table->char('common_shared', 4)->default(0);
            $table->char('functional', 4)->default(0);
            $table->char('non_functional', 4)->default(0);
            $table->boolean('min_or_repair')->default(0);
            $table->boolean('pwsn_hand_rail_outside')->default(0);
            $table->boolean('pwsn_hand_rail_inside')->default(0);
            $table->boolean('pwsn_ramp')->default(0);
            $table->boolean('pwsn_stair')->default(0);
            $table->boolean('pwsn_high_commode')->default(0);
            $table->boolean('hwd')->default(0);
            $table->boolean('hwd_water')->default(0);
            $table->boolean('hwd_soap')->default(0);
            $table->decimal('longitude', 10, 7);
            $table->decimal('latitude', 10, 7);
            $table->float('total_chamber', 10, 7)->default(0);
            $table->float('total_ring_number', 10, 7)->default(0);
            $table->float('dia_of_ring', 10, 7)->default(0)->comment('Dia of Ring (In Inches)');
            $table->float('septic_tank_dimension', 10, 7)->default(0)->comment('Dimension of septic tank (Feet)');
            $table->float('total_volume', 10, 7)->default(0)->comment('Total volume meter cube');
            $table->longText('remarks')->nullable();
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
        Schema::dropIfExists('latrines');
    }
};
