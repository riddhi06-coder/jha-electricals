<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Category;

use Carbon\Carbon;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::whereNull('deleted_by')->get(); 
        return view('backend.category.index', compact('categories'));
    }

    public function create(Request $request)
    { 
        return view('backend.category.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ], [
            'category_name.required' => 'The category name is required.',
            'category_name.string' => 'The category name must be a valid string.',
            'category_name.max' => 'The category name must not exceed 255 characters.',
        ]);
    

        $slug = Str::slug($request->category_name, '-');
    
        Category::create([
            'category_name' => $request->category_name,
            'slug' => $slug,
            'inserted_at' => Carbon::now(),
            'inserted_by' => Auth::id(), 
        ]);
    
        return redirect()->route('category.index')->with('message', 'Category created successfully.');
    }

    public function edit($id)
    {
        $details = Category::findOrFail($id);
        return view('backend.category.edit', compact('details'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ], [
            'category_name.required' => 'The category name is required.',
            'category_name.string' => 'The category name must be a valid string.',
            'category_name.max' => 'The category name must not exceed 255 characters.',
        ]);
    
        $category = Category::findOrFail($id);
    
        $slug = Str::slug($request->category_name, '-');
    
        $category->update([
            'category_name' => $request->category_name,
            'slug' => $slug,
            'updated_at' => Carbon::now(),
            'updated_by' => Auth::id(), 
        ]);
    
        return redirect()->route('category.index')->with('message', 'Category updated successfully.');
    }
    

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Category::findOrFail($id);
            $industries->update($data);

            return redirect()->route('category.index')->with('message', 'Category deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}