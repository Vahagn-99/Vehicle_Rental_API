<?php

use App\Models\Enums\VehicleAvailabilityStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('model_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('vin')->unique();
            $table->string('number_plate')->unique();
            $table->string('availability_status', 255)->default(VehicleAvailabilityStatus::PREPARING);
            $table->json('location')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
