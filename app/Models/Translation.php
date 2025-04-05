<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Ingredient;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = [
        'portuguese_ingredient',
        'translation_note'
    ];

    // Translation has one ingredient
    public function ingredient(): HasOne
    {
        return $this->hasOne(Ingredient::class);
    }
}
