<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cemeteries', function (Blueprint $table) {
            $table->decimal('latitude', 8, 6)
                ->nullable()
                ->after('address');
            $table->decimal('longitude', 9, 6)
                ->nullable()
                ->after('address');

            if (Schema::hasColumn('cemeteries', 'coordinates')) {
                $table->dropColumn('coordinates');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cemeteries', function (Blueprint $table) {
            if (Schema::hasColumn('cemeteries', 'latitude')) {
                $table->dropColumn('latitude');
            }

            if (Schema::hasColumn('cemeteries', 'longitude')) {
                $table->dropColumn('longitude');
            }

            if (!Schema::hasColumn('cemeteries', 'coordinates')) {
                $table->json('coordinates')->nullable();
            }
        });
    }
};
