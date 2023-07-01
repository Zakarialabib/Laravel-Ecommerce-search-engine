<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', static function (Blueprint $table): void {
            $table->id();
            $table->uuid();
            $table->string('name')->nullable();
            $table->string('label')->nullable();
            $table->string('type');
            $table->integer('price')->default(0);
            $table->json('features')->nullable();
            $table->boolean('status')->default(true); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
