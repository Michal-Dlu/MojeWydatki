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
        Schema::table('expenses', function (Blueprint $table) {
            // Sprawdzenie, czy indeks istnieje przed jego usunięciem
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $indexes = $sm->listTableIndexes('expenses');

            if (array_key_exists('expenses_sklep_customer_id_unique', $indexes)) {
                $table->dropUnique('expenses_sklep_customer_id_unique');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->unique(['sklep', 'customer_id']);
        });
    }
};
