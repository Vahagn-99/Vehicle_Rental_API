<?php

use App\Models\Enums\BalanceStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('renter_id')
                ->constrained('users', 'id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('total')->default(0);
            $table->string('currency')->default("usd");
            $table->string('status')->default(BalanceStatus::UNAVAILABLE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('balances');
    }
};
