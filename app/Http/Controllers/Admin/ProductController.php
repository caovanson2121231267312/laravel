<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $keywords = $request->keywords;
            $search_category = $request->search_category;
            $status = $request->status;

            $data = Product::with(["category", "user"]);
            if (!empty($keywords)) {
                $data->where("name", "like", "%$keywords%");
            }
            if (!empty($search_category)) {
                $data->where("category_id", $search_category);
            }
            if (!empty($status)) {
                $data->where('status', $status);
            }
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '';
                })
                // ->editColumn('status', function ($row) {
                //     $status_value = "";
                //     if ($row->status == 1) {
                //         $status_value = "<div class='text-info'>sắp ra mắt</div>";
                //     } elseif ($row->status == 2) {
                //         $status_value = "<div class='text-success'>đang được bán</div>";
                //     } else {
                //         $status_value = "<div class='text-danger'>hết hàng</div>";
                //     }
                //     return $status_value;
                // })
                ->rawColumns(['status', 'action'])
                ->make(true);
        } else {

            $categories = Category::get();
            return view("admins.product.index", ['categories' => $categories]);
        }
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
    public function store(ProductRequest $request)
    {
        $data = [
            "name" => $request->name,
            "category_id" => $request->category_id,
            "user_id" => Auth::user()->id,
            "price" => $request->price,
            "sale" => $request->sale,
            "stock" => $request->stock,
            "content" => $request->content,
            "description" => $request->description,
            "status"=>$request->status
        ];
        if ($files = $request->file('img')) {
            $fileName = $files->getClientOriginalName();
            $fileExt = $files->getClientOriginalExtension();
            $fileName = Str::slug(pathinfo($fileName, PATHINFO_FILENAME)) . '-' . Carbon::now()->timestamp;
            $file_path = 'storage/images/product/' . $fileName . '.' . $fileExt;
            $files->move('storage/images/product/', $fileName . '.' . $fileExt);

            $data['img'] = $file_path;
        }
        Product::create($data);
        return response()->json([
            "success" => 'bạn đã thêm sản phẩm thành công'
        ], 200);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
