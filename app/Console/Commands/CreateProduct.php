<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Console\Command;

class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        // $category = Category::first();

        // $user = User::first();

        // $data = Product::create([
        //     "name" => 'iphone 6',
        //     "img" => 'assets/img/shop01.png',
        //     "description"  => 'day la ip 6',
        //     "price" => "5000000",
        //     "content" => " co nhieu tinh nang vuot troi",
        //     "sale" => 30,
        //     "stock" => 100,
        //     "status" => 1,
        //     "user_id" => $user->id,
        //     "category_id" => $category->id,
        // ]);


        $data = Product::find(1)->load(['category', 'user']);


        dump($data);
        dump($data->name);
        dump($data->category->name);
        dump($data->user->name);
        dump($data->user->email);

    }
}
