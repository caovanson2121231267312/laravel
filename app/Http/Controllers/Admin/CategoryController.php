<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::latest("id")->paginate(10);

        return view('admins.categories.index', [
            "data" => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admins.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Category::create([
            "name" => $request->name,
            "description" => $request->description,
        ]);

        return redirect()->route("category.index")->with([
            "success" => "Đã thêm 1 danh mục mới"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.ed
     */
    public function edit(string $id)
    {
        try {
            
            $edit = Category::findOrFail($id);
            return view("admins.categories.edit", ['edit' => $edit]);

        } catch (Exception $e) {
            return redirect()->route("category.index")->with([
                "error" => "Danh mục không tồn tại"
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $data = Category::find($id);

        $data->update([
            "name" => $request->name,
            "description" => $request->description,
        ]);
        return redirect()->route('category.index')->with([
            "success" => 'Sửa thành công danh mục'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Category::find($id);
        $data->delete();

        return redirect()->route("category.index")->with([
            "success" => "Đã xóa thành công"
        ]);
    }
}
