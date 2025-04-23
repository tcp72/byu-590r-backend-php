<html>
    Hello, this is the report of recipe names!

    <ul>
        @foreach ($recipes as $recipe)
            <li>{{$recipe->recipe_name}}</li>
        @endforeach
    </ul>

    That's it!
</html>