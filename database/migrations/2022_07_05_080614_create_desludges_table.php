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
        Schema::create('desludges', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->id();
            $table->date('collection_date');
            $table->foreignId('latrine_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->float('count_desludge_ring', 10, 7)->default(0);
            $table->float('desludged_height_from_top', 10, 7)->default(0)->comment('Septic tank height desludged from Top (feet)');
            $table->float('total_volume_desludged', 10, 7)->default(0)->comment('Total volume desludged ,meter cube');
            $table->boolean('see_foreign_materials')->default(0)->comment('Did you see any foreign materials ( Plastic bottle, shoes, cloths etc)?');
            $table->string('sludge_transferred_to')->default(0)->comment('Did you see any foreign materials ( Plastic bottle, shoes, cloths etc)?');
            $table->string('litre_of_petrol')->default(0)->comment('Litre of Petrol used (For this latrine desludging only) ?');
            $table->string('man_woman_days_used')->default(0)->comment('Man/Woman power used for this latrine desludging?');
            $table->decimal('longitude', 10, 7);
            $table->decimal('latitude', 10, 7);
            $table->longText('remarks')->nullable();
            $table->enum('status', ['Pending', 'Verified'])->default('Pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('desludges');
    }
};
