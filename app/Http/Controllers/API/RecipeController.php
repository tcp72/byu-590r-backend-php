<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Models\Recipes;

class RecipeController extends BaseController
{
    /**
     * Disiplay a listing of the resource
     * 
     * @return \Illuminate\Http\Response   /api/recipes GET
     */
    
     public function index()
    {
      
        $recipes = Recipes::get(); //this is where we call the model. could also do all for all relationships
    
        foreach($recipes as $recipe){ //this is turning this file object into the full path
            $recipe->file = $this->getS3Url($recipe->file);
        }
       

        return $this->sendResponse($recipes, 'Recipes');
    }
}

