<?php

use App\Enums\EnumScrapStatus;
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
        Schema::create('cemeteries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('src')->unique();
            $table->json('phone')->nullable();
            $table->json('website')->nullable();
            $table->json('alt_name')->nullable();
            $table->string('address')->nullable();
            $table->json('coordinates')->nullable();
            $table->unsignedBigInteger('location_id');
            $table->longText('description')->nullable();
            $table->tinyInteger('status')->default(EnumScrapStatus::NEED_SCRAPING);
            $table->timestamps();

            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cemetery');
    }
};
