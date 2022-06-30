<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function create()
    {
        return view('/categories/create');
    }

    public function store(CreateCategoryRequest $request)
    {
        // TODO check :: validatie graag afhandelen in een Request
        $validated = $request->validated();
        // TODO check :: Kijk is of je Category::creat() kunt gebruiken
        Category::create([
            'name' => ucfirst($validated['name'])
        ]);
        return redirect(route('category.create'))->with('succes', 'Category succesfully added!');
    }
}
