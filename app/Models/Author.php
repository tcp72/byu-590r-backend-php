<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //
    use HasFactory;

    protected $table = 'authors';
    
    protected $fillable = [
        'author_name',
        'author_home_town'
    ];

    /**
     * Get the recipes for the author.
     */
    public function recipes()
    {
        return $this->hasMany(Recipe::class, 'author_id');
    }
}
