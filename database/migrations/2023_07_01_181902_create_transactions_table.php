<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', static function (Blueprint $table): void {
            $table->id();
            $table->uuid();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('package_id')->constrained()->nullable()->cascadeOnDelete();
            $table->foreignId('subscription_id')->constrained()->nullable()->cascadeOnDelete();
            $table->string('type');
            $table->string('amount')->default(0);
            $table->boolean('status')->default(true); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
