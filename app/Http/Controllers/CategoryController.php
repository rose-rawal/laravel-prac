<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //:where("id", 1)->first()
    public function getAction()
    {
        $categories = Category::all();
        dd($categories->toArray());
    }
}