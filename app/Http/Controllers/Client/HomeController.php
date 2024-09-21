<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('client.home.index');
    }

    public function product($slug)
    {
        $data = Product::findBySlugOrFail($slug);

        return view('client.product.index', ["data" => $data]);
    }

    public function stores()
    {
        return view('client.store.index');
    }
}
