<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Category;
use App\Models\Orderdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class ShareCategory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $categories = Category::get();

        $total_order = 0;
        if (Auth::check()) {
            $total_order = Orderdetail::join('orders', 'orders.id', '=', "order_details.order_id")
                ->where('user_id', auth()->user()->id)
                ->where("status", 1)->sum("amount");
        }

        View::share([
            'categories' => $categories,
            'total_order' => $total_order
        ]);

        return $next($request);
    }
}
