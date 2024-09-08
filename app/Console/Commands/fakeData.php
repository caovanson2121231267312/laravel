<?php

namespace App\Console\Commands;

use Goutte\Client;
use App\Models\Category;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class fakeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fake-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public $domain = "https://hoanghamobile.com";

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $crawler = (new Client())->request('GET', $this->domain);

        $crawler->filter('nav ul.root li span')->each(
            function (Crawler $node) {
                $name = $node->filter('span')->html();

                try {
                    $category = Category::create([
                        "name" => $name,
                        "description" => $name
                    ]);

                    $this->info("Tạo thành công " . $name . "\n");
                } catch (\Throwable $th) {

                    $this->error("category đã có" . "\n");
                    
                    $this->error($th->getMessage());
                }
            }
        );

    }
}
