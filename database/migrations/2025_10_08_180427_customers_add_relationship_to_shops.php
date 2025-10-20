<?php

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
        Schema::table('shops', function (Blueprint $table) {
                
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->unique(['sklep', 'customer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropUnique(['sklep', 'customer_id']);
            $table->dropColumn('customer_id');
        });
    }
};
