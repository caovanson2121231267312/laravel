<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Orderdetail;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Order::with('user')->withCount('order_detail');

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '';
                })
                ->editcolumn('created_at',function($row){
                    if($row->created_at){
                        return Carbon::parse($row->created_at)->format('d-m-Y');
                    }
                })
                ->editcolumn('updated_at',function($row){
                    if($row->updated_at){
                        return Carbon::parse($row->updated_at)->format('d-m-Y');
                    }
                })
                ->rawColumns(['status', 'action'])
                ->make(true);

        } else {
            return view('admins.order.index');
        }
    }

    public function show($id) {
        $data = Orderdetail::where('order_id', $id)->with(['product'=>function($query){

            $query->with(['category']);
        }])->get();



        return view("admins.order.show", ["data" => $data]);
    }
}
