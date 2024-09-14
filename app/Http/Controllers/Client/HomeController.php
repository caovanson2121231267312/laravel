<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('client.home.index');
    }

    public function product()
    {
        return view('client.product.index');
    }

    public function stores()
    {
        return view('client.store.index');
    }
}
