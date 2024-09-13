<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Enums\EnumScrapStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->tinyInteger('type');
            $table->string('src')->unique();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->tinyInteger('status')->default(EnumScrapStatus::NEED_SCRAPING->value);
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on('locations')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location');
    }
};
