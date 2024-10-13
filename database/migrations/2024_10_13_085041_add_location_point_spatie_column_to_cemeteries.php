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
        Schema::table('cemeteries', function (Blueprint $table) {
            if (Schema::hasColumn('cemeteries', 'coordinates')) {
                $table->dropColumn('coordinates');
            }

            if (Schema::hasColumn('cemeteries', 'location')) {
                $table->dropColumn('location');
            }

            $table->geometry('location_point')
                ->nullable()
                ->after('office_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cemeteries', function (Blueprint $table) {
            if (Schema::hasColumn('cemeteries', 'location_point')) {
                $table->dropColumn('location_point');
            }

            $table->json('coordinates')
                ->nullable()
                ->after('office_address');
        });
    }
};
