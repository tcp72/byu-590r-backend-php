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
        //Schema::dropIfExists('recipes');
        Schema::create('recipes', function (Blueprint $table) {
            $table->id(); // Standard Laravel primary key
            $table->foreignId('author_id')->constrained()->onDelete('cascade');
            $table->string('recipe_name');
            $table->integer('total_time'); // Assuming total_time is stored as an integer (minutes
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

// Laravel's foreign key system works by convention - when you use constrained() without parameters, it assumes:

//     The referenced table is the plural form of the column name without "_id"
    
//     The referenced column is "id"