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
            $table->longText('additional_info')
                ->nullable()
                ->after('description');
            $table->text('office_address')
                ->nullable()
                ->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cemeteries', function (Blueprint $table) {
            if (Schema::hasColumn('cemeteries', 'additional_info')) {
                $table->dropColumn('additional_info');
            }

            if (Schema::hasColumn('cemeteries', 'office_address')) {
                $table->dropColumn('office_address');
            }
        });
    }
};
