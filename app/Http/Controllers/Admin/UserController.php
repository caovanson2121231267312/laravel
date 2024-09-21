<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $keywords = $request->keywords;
            $establish = $request->establish;

            $data = User::query();

            if (!empty($keywords)) {
                $data->where("name", "like", "%$keywords%");
            }
            if (!empty($establish)) {
                $data->whereDate("establish", $establish);
            }

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '';
                })
                ->editColumn('establish', function ($row) {


                    if (!empty($row->establish)) {
                        return Carbon::parse($row->establish)->format('d-m-Y');
                    }
                    return 'Chưa cập nhật';
                })
                ->editColumn('created_at', function ($row) {
                    // dd($row);
                    if (!empty($row->created_at)) {
                        return Carbon::parse($row->created_at)->format('d-m-Y');
                    }
                    return '';
                })
                ->make(true);
        } else {
            return view("admins.users.index");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = [
            "name" => $request->name,
            'email' => $request->email,
            // 'avatar' => $request->avatar,
            'establish' => $request->establish,
            'password' => Hash::make($request->password)
        ];

        if ($files = $request->file('avatar')) {
            $fileName = $files->getClientOriginalName();
            $fileExt = $files->getClientOriginalExtension();
            $fileName = Str::slug(pathinfo($fileName, PATHINFO_FILENAME)) . '-' . Carbon::now()->timestamp;
            $file_path = 'storage/images/users/' . $fileName . '.' . $fileExt;
            $files->move('storage/images/users/', $fileName . '.' . $fileExt);
        }

        $data["avatar"] = $file_path;

        User::create($data);

        return response()->json([
            "success" => "Đã thêm tài khoản mới",
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $data=User::find($id);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try {
            $data = User::FindOrFail($id);
            return view("admins.users.show", ['data' => $data]);
        } catch (Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = User::find($id);

        $data_user = [
            "name" => $request->name,
            "email" => $request->email,
        ];

        if (!empty($request->avatar)) {
            if ($files = $request->file('avatar')) {
                $fileName = $files->getClientOriginalName();
                $fileExt = $files->getClientOriginalExtension();
                $fileName = Str::slug(pathinfo($fileName, PATHINFO_FILENAME)) . '-' . Carbon::now()->timestamp;
                $file_path = 'storage/images/users/' . $fileName . '.' . $fileExt;
                $files->move('storage/images/users/', $fileName . '.' . $fileExt);
            }

            $data_user["avatar"] = $file_path;
        }
        if (!empty($request->establish)) {
            $data_user['establish'] = $request->establish;
        }

        $data->update($data_user);

        return response()->json([
            'success' => 'upadte success'
        ], 200);
    }

    public function destroy(string $id)
    {

        try {
            $data = User::findOrFail($id);
            $data->delete();
            return response()->json([
                'success' => "Xóa thành công",
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => "$id khong ton tai",
            ], 500);
        }
    }
}
