<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class thumuc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-app';

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
        $this->info("start");


        // Category::create([
        //     'name' => 'dfg',
        //     'description' => '123'

        // ]);
        // Category::create([
        //     'name' => 'son',
        //     'description' => 'ha noi'

        // ]);
        // Category::create([
        //     'name' => 'vinh',
        //     'description' => 'da nang'
        // ]);
        // $data = Category::where('id', 2)->first();

        $data =  Category::get();

        foreach($data as $key => $value){
            $value->update([
                "name" => $key,
            ]);
        }
        // $data->update([
        //     'name' => 'sai gon'
        // ]);
        // $data->delete();

        // dump($data);
        // $date=Category::get()->toArray();
        dump($data);


        $this->info("Done");
    }

}
