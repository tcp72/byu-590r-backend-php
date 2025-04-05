<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Translation;
use App\Models\Recipe;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingredient_name',
        'ingredient_note',
        'translation_id'
    ];

    // Ingredient belongs to one translation
    public function translation(): BelongsTo
    {
        return $this->belongsTo(Translation::class);
    }

    // Ingredient belongs to many recipes through the pivot table
    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class, 'recipe_ingredients', 'ingredient_id', 'recipe_id')
                    ->withPivot('quantity');
    }
}
