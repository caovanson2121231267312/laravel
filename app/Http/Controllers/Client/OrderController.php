<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function cart() {
        $user_id = Auth::user()->id;

        $order = Order::with(['order_detail' => function ($query) {
                        $query->with([
                            "product" => function ($query_1) {
                                $query_1->with("category");
                            }
                        ]);
                    }])
                    ->where("user_id", $user_id)->where("status", 1)->first();

        // dd($order->toArray());

        return view("client.cart.index", [
            "order" => $order
        ]);
    }

    public function add_to_cart(Request $request)
    {
        // dd($request->all());

        try {
            $user_id = Auth::user()->id;
            $product = Product::find($request->product_id);

            $order = Order::where("user_id", $user_id)->where("status", 1)->first();

            if(empty($order)) {
                $order = Order::create([
                    "user_id" => $user_id,
                    "status" => 1,
                    "address" => "",
                ]);
            }

            $order_product = Orderdetail::where("order_id", $order->id)->where("product_id", $request->product_id)->first();

            if(empty($order_product)) {
                Orderdetail::create([
                    "product_id" => $request->product_id,
                    "order_id" => $order->id,
                    "amount" => $request->amount,
                    "order_price" => $product->price,
                    "order_sale" => $product->sale,
                ]);
            } else {
                $order_product->update([
                    "amount" =>  $order_product->amount + $request->amount,
                ]);
            }

            return redirect()->route("cart")->with([
                "success" => "Đã thêm sản phẩm thành công"
            ]);
        } catch (Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with([
                "error" => $e->getMessage()
            ]);
        }
    }
}
