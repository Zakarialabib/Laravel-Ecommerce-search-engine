<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('price_histories', static function (Blueprint $table): void {
            $table->id();
            $table->uuid();

            $table->decimal('price', 10, 2);
            $table->decimal('old_price', 10, 2);
            $table->foreignId('price_id')->references('id')->on('prices')->onDelete('cascade');

            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_histories');
    }
};
