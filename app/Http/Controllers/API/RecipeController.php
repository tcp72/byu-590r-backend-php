<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Models\Recipe; //I previously had plural
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; //chat had me import this. What does it do?

class RecipeController extends BaseController
{
    /**
     * Display a listing of the resource
     * 
     * @return \Illuminate\Http\Response   /api/recipes GET
     */
    
     public function index()
    {
      
        // This eager loads the author relationship to avoid N+1 query problem
        $recipes = Recipe::with('author')->get();

        // $recipes = Recipe::get(); //this gets all. if wanted to order by would be book:orderby('name_of_col', 'desc') -> get()this is where we call the model. could also do all for all relationships
    
        foreach($recipes as $recipe){ //this is turning this file object into the full path
            $recipe->file = $this->getS3Url($recipe->file);
        }
       
        return $this->sendResponse($recipes, 'Recipes retrieved successfully');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipe_name' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'total_time' => 'required|integer',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        //file handling with custom naming strategy
        if ($request->hasFile('file')) {
            $authUser = Auth::user();
            $extension = $request->file('file')->getClientOriginalExtension();
            $image_name = time() .'_recipe_' . $authUser->id . '.' . $extension;
            
            $path = $request->file('file')->storeAs(
                'images',
                $image_name,
                's3'
            );
            
            //Added visibility setting for S3
            Storage::disk('s3')->setVisibility($path, "public");
            
            if(!$path) {
                return $this->sendError($path, 'Recipe image failed to upload!');
            }
            
            $validated['file'] = $path;
        }

        $recipe = Recipe::create($validated);
        $recipe->file = $this->getS3Url($recipe->file);

        return $this->sendResponse($recipe, 'Recipe created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = Recipe::with('author')->findOrFail($id);
        $recipe->file = $this->getS3Url($recipe->file);

        return $this->sendResponse($recipe, 'Recipe retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $recipe = Recipe::findOrFail($id);

        // HIGHLIGHT: Added validation based on schema
        $validated = $request->validate([
            'recipe_name' => 'sometimes|required|string|max:255',
            'author_id' => 'sometimes|required|exists:authors,id',
            'total_time' => 'sometimes|required|integer',
            'file' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // HIGHLIGHT: Added file handling with custom naming strategy
        if ($request->hasFile('file')) {
            // Delete old file
            if ($recipe->file) {
                Storage::disk('s3')->delete($recipe->file);
            }
            
            $authUser = Auth::user();
            $extension = $request->file('file')->getClientOriginalExtension();
            $image_name = time() .'_recipe_' . $authUser->id . '.' . $extension;
            $path = $request->file('file')->storeAs(
                'images',
                $image_name,
                's3'
            );
            
            Storage::disk('s3')->setVisibility($path, "public");
            
            if(!$path) {
                return $this->sendError($path, 'Recipe image failed to upload!');
            }
            
            $validated['file'] = $path;
        }

        $recipe->update($validated);
        $recipe->file = $this->getS3Url($recipe->file);

        return $this->sendResponse($recipe, 'Recipe updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);

        // HIGHLIGHT: Added file deletion from S3
        if ($recipe->file) {
            Storage::disk('s3')->delete($recipe->file);
        }

        $recipe->delete();
    
        return $this->sendResponse(null, 'Recipe deleted successfully');
    }

}

