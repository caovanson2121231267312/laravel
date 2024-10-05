<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Jobs\SendEmail;
use App\Jobs\UpdateUser;
use App\Exports\UserExport;
use Illuminate\Support\Str;
use App\Mail\SendMailToUser;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
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
        $avatar = "";
        if (!empty($request->avatar)) {
            if ($files = $request->file('avatar')) {
                $fileName = $files->getClientOriginalName();
                $fileExt = $files->getClientOriginalExtension();
                $fileName = Str::slug(pathinfo($fileName, PATHINFO_FILENAME)) . '-' . Carbon::now()->timestamp;
                $file_path = 'storage/images/users/' . $fileName . '.' . $fileExt;
                $files->move('storage/images/users/', $fileName . '.' . $fileExt);
            }

            $avatar = $file_path;
        }

        UpdateUser::dispatch($id, $request->all(), $avatar);

        return response()->json([
            'success' => 'upadte success'
        ], 200);
    }

    public function changepassword(Request $request)
    {
        $data = User::find($request->user_id);
        // dump($request->user_id);

        if ($request->password != $request->password_confirmation) {
            return response()->json([
                "error" => "mật khẩu không khớp"
            ], 500);
        } else {
            $data->update([
                "password" => Hash::make($request->password),
            ]);
            return response()->json([
                "success" => "Thay đổi password thành công"
            ], 200);
        }
    }
    public function sendmail(Request $request)
    {
        try {
            $user = User::find($request->user_id);

            $mailData = [
                "name" => $user->name,
                "title" => "Gửi email sale cuối tuần",
                "content" => $request->text_content,
            ];

            // Mail::to($user->email)->send(new SendMailToUser($mailData));
            SendEmail::dispatch($mailData, $user);

            return response()->json([
                "success" => "Đã gửi email tới " . $user->name . " thành công",
            ], 200);
        } catch (Exception $e) {

            return response()->json([
                "error" => $e->getMessage()
            ], 500);
        }
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

    public function export(Request $request)
    {
        return Excel::download(new UserExport(), 'users.xlsx');
    }
}
