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
            $table->renameColumn('status', 'scrap_status');
            $table->tinyInteger('visibility')
                ->after('scrap_status')
                ->default(\App\Enums\EnumVisibility::PUBLIC);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cemeteries', function (Blueprint $table) {
            if (Schema::hasColumn('cemeteries', 'scrap_status')) {
                $table->renameColumn('scrap_status', 'status');
            }

            if (Schema::hasColumn('cemetery', 'visibility')) {
                $table->dropColumn('visibility');
            }
        });
    }
};
