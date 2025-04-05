<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Author;
use App\Models\Ingredient;


class Recipe extends Model //laravel assumes thta lowercse of his class is taable name
{
    use HasFactory;

    protected $fillable = [
        'recipe_name',
        'author_id',
        'file',
        'total_time'
    ];

    //recipe belongs to one author
    public function author(): BelongsTo {
        return $this->belongsTo(Author::class);
    }

    public function ingredients(): BelongsToMany {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients', 'ingredient_id', 'recipe_id')->withPivot('quantity');
    }
}


//make all tables and migrations, including pivot tables
//then seed entities that don't have foreign keys
//then seed entities that do have foreign keys on them (including pivot tables)
//the recipe fields (file, total_time, etc. don't need to go in the odel. Just in the migration)