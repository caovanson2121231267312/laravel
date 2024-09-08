<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-category';

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
        $this->info("start..");

        // Category::create([
        //     "name" => "Laptop"
        // ]);
        // Category::create([
        //     "name" => "Iphone"
        // ]);
        // Category::create([
        //     "name" => "Điện thoại"
        // ]);

        // $data = Category::where("id", 1)->get()->toArray();
        $data = Category::where("id", 1)->first();

        $data->delete();

        // Category::truncate();
        $data = Category::get()->toArray();

        // foreach($data as $value) {
        //     $this->info("id: " . $value->id);
        //     $this->info("name: " . $value->name);
        // }

        dump($data);

        // $this->info("Done create");
    }
}
