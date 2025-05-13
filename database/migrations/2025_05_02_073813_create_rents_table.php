<?php

use App\Models\Enums\RentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('renter_id')
                ->constrained('users', 'id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('vehicle_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('status')->default(RentStatus::ORDER_ACCEPTED);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('rents');
    }
};
