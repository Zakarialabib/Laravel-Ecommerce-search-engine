<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('tracks', static function (Blueprint $table): void {
            $table->id();
            $table->uuid();
            $table->string('belongs_to_type');
            $table->integer('belongs_to');
            $table->string('type');
            $table->ipAddress('ip');
            $table->string('time_checker');
            $table->boolean('is_featured');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};
