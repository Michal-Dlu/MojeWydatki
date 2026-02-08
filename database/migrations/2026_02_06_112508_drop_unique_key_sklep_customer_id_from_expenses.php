    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Support\Facades\DB;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            // Usuń indeks bezpiecznie - tylko jeśli istnieje
            DB::statement("ALTER TABLE expenses DROP INDEX IF EXISTS expenses_sklep_customer_id_unique");
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