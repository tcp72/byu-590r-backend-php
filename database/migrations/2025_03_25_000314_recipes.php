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
        // Schema::dropIfExists('recipes');
        // Schema::create('recipes', function(Blueprint $table): {


        // });

        Schema::dropIfExists('recipes');
        Schema::create('recipes', function (Blueprint $table) {
            $table->id('recipe_id'); // Primary key
            //$table->unsignedBigInteger('author_id')->nullable(); // Placeholder for foreign key (not enforced)
            //$table->unsignedBigInteger('rec_ing_id'); // Placeholder for foreign key (not enforced)
            $table->string('recipe_name');
            $table->integer('total_time'); // Assuming total_time is stored as an integer (minutes)
            $table->string('file');
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');

    }
};
