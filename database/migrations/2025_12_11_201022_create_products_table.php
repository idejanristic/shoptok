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
        Schema::create(
            table: 'products',
            callback: function (Blueprint $table): void {
                $table->id();
                $table->string(column: 'name');
                $table->string(column: 'productId')->unique();

                $table->foreignId(column: 'brand_id')
                    ->nullable()
                    ->constrained(table: 'brands', column: 'id')
                    ->nullOnDelete()
                    ->nullOnUpdate();

                $table->foreignId('category_id')
                    ->nullable()
                    ->constrained('categories')
                    ->nullOnDelete();

                $table->decimal(column: 'price', total: 10, places: 2);
                $table->integer(column: 'discount')->nullable();
                $table->text(column: 'image')->nullable();
                $table->text(column: 'link')->nullable();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'products');
    }
};
