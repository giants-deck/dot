<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $category = Category::create($input);
        toast($category->cat_name.' Category Created', 'info')->position('bottom-end');
        return redirect('admin/categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $input = $request->all();
        $category->update($input);
        toast('Category Updated', 'info')->position('bottom-end');
        return redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->isAdmin()){
            $category = Category::findOrFail($id);
            toast($category->cat_name.' Category Deleted', 'info')->position('bottom-end');
            $category->delete();
            return redirect('admin/categories');
        }else{
            toast('You don\'t have permission', 'error')->position('bottom-end');
            return redirect('admin/categories');
        }
    }
}
