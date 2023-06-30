<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('user_subscriptions', static function (Blueprint $table): void {
            $table->id();
            $table->uuid();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
            $table->foreignId('order_id')->references('id')->on('subscription_orders')->onDelete('cascade');
            $table->date('starts_at');
            $table->date('ends_at');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_subscriptions');
    }
};
