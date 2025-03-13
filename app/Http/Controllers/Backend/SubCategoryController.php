<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\SubCategory;
use App\Models\Category;
use Carbon\Carbon;


class SubCategoryController extends Controller
{

    public function index()
    {
        return view('backend.sub-category.index');
    }

    public function create()
    {
        $categories = Category::all(); 
        return view('backend.sub-category.create', compact('categories'));
    }
    

}