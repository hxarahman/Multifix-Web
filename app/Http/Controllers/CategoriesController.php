<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    public function api()
    {
        $data = Categories::all();

        return $data;
    }
}
