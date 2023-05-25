<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Product;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendor_highlighteds', static function (Blueprint $table): void {
            $table->id();
            $table->uuid();
            $table->string('placement_type');
            $table->decimal('price', 8, 2);
            $table->boolean('approved')->default(false);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            
            $table->foreignId(User::class)->nullable();
            $table->foreignId(Product::class)->nullable();

            $table->boolean('status')->default(true); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor_highlighteds');
    }
};
