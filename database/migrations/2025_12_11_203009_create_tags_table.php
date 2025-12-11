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
            table: 'tags',
            callback: function (Blueprint $table): void {
                $table->id();
                $table->string(column: 'name')->unique();
                $table->timestamps();
            }
        );

        Schema::create(
            table: 'product_tag',
            callback: function (Blueprint $table): void {
                $table->foreignId(column: 'product_id')
                    ->constrained(table: 'products', column: 'id')
                    ->onDelete(action: 'cascade')
                    ->onUpdate(action: 'cascade');

                $table->foreignId(column: 'tag_id')
                    ->constrained(table: 'tags', column: 'id')
                    ->onDelete(action: 'cascade')
                    ->onUpdate(action: 'cascade');

                // Timestamps
                $table->timestamps();

                $table->primary(columns: ['product_id', 'tag_id']);
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'product_tag');
        Schema::dropIfExists(table: 'tags');
    }
};
