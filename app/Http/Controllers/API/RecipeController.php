<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Models\Recipe; //I previously had plural
use \App\Models\Author;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; //chat had me import this. What does it do?
use Illuminate\Support\Facades\Validator;

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
        $recipes = Recipe::with('author', 'ingredients')->get();

        // $recipes = Recipe::get(); //this gets all. if wanted to order by would be book:orderby('name_of_col', 'desc') -> get()this is where we call the model. could also do all for all relationships
    
        foreach($recipes as $recipe){ //this is turning this file object into the full path
            $recipe->file = $this->getS3Url($recipe->file);
        }

        // Fetch all authors
        $authors = Author::all();
       
        return $this->sendResponse([
            'recipes' => $recipes,
            'authors' => $authors
        ], 'Recipes and authors retrieved successfully');
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

        $recipeFinal = Recipe::where('id',$recipe->id)->with('author', 'ingredients')->first(); 
        $recipeFinal->file = $this->getS3Url($recipeFinal->file);

        return $this->sendResponse($recipeFinal, 'Recipe created successfully');

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
            //remember image in different place
        ]);       

        $recipe->update($validated);

        $recipeFinal = Recipe::where('id',$recipe->id)->with('author', 'ingredients')->first(); 
        $recipeFinal->file = $this->getS3Url($recipeFinal->file);

        return $this->sendResponse($recipeFinal, 'Recipe updated successfully');
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

    public function updateRecipePicture(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $recipe = Recipe::findOrFail($id);

        if ($request->hasFile('file')) {
        
            $extension  = request()->file('file')->getClientOriginalExtension(); //This is to get the extension of the image file just uploaded
            $image_name = time() .'_recipe_picture.' . $extension;
            $path = $request->file('file')->storeAs(
                'images',
                $image_name,
                's3'
            );
            Storage::disk('s3')->setVisibility($path, "public");
            if(!$path) {
                return $this->sendError($path, 'recipe image failed to upload!');
            }
            
            $recipe->file = $path;

        } 
        $recipe->save();


        if(isset($recipe->file)){
            $recipe->file = $this->getS3Url($recipe->file);
        }
        $success['recipe'] = $recipe;
        return $this->sendResponse($success, 'Recipe image successfully updated!');
    }

}

