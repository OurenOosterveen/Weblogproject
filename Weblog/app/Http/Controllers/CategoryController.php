<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function create()
    {
        return view('/categories/create');
    }

    public function store()
    {
        // TODO :: validatie graag afhandelen in een Request
        request()->validate([
            'name' => 'required|unique:categories,name|min:3|max:255'
        ]);
        // TODO :: Kijk is of je Category::creat() kunt gebruiken
        $category = new Category();
        // TODO :: gevalideerde data gebruiken
        $category->name = ucfirst(request('name'));

        $category->save();

        return redirect(route('category.create'));
    }
}
