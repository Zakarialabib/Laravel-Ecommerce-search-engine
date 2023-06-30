<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('stores', static function (Blueprint $table): void {
            $table->id();
            $table->uuid();
            $table->string('name');
            $table->string('phone');
            $table->string('url');
            $table->string('slug');
            $table->string('location')->nullable();
            $table->string('logo')->nullable();
            $table->text('banner_image')->nullable();
            $table->json('social_links')->nullable();
            $table->boolean('status')->default(true);
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
