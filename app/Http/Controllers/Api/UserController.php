<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Catch_;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::paginate(10);

        return response()->json([
            "data" => $data,
        ], 200);
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
        try {
            // dd($request->all());
            $data = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'success' => 'Đã tạo thành công người dùng'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "data" => "Đã có lỗi xảy ra",
                "error_message" => $e->getMessage(),
            ], 500);
        }
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
        try {
            $data = User::find($id);
            $data->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return response()->json([
                'success' => 'Đã cập nhập thành công người dùng',
                'data' => $data,
            ], 200);
        } catch (Exception $e) {

            return response()->json([
                "data" => "Đã có lỗi xảy ra",
                "error_message" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = User::find($id);
            $data->delete();
            return response()->json([
                'success' => 'Đã xóa thành công người dùng',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "data" => "Đã có lỗi xảy ra",
                "error_message" => $e->getMessage(),
            ], 500);
        }
    }
}
