<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::create('balance_operations_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('balance_id')
                ->constrained('balances', 'id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('amount')->default(0);
            $table->string('currency')->default("usd");
            $table->string('type');
            $table->timestamp("operation_date")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('balance_operations_histories');
    }
};
