<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    

    public function create() {
        return view('/categories/create');
    }

    public function store() {
        request()->validate([
            'name' => 'required|unique:categories,name|min:3|max:255'
        ]);

        $category = new Category();
        $category->name = ucfirst(request('name'));

        $category->save();

        return redirect(route('category.create'));
    }
}
