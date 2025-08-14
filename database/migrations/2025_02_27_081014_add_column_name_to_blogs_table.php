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
        Schema::table('blogs', function (Blueprint $table) {
            $table->foreignId('category_id')
            ->nullable() // Make it nullable
            ->after('id') // Place it after the 'id' column
            ->constrained('blog_categories')
            ->onDelete('cascade');        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // Drop the foreign key constraint
        $table->dropColumn('category_id'); // Drop the column
        });
    }
};
