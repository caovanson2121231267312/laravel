<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class testTimeLaravel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-time-laravel';

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
        $zone = "Asia/Ho_Chi_Minh";
        $now = Carbon::now($zone);

        $this->info($now);

        $this->info($now->toDateString());

        $this->info($now->format("d-m-Y"));
        $this->info($now->format("H:i:s d-m-Y"));

        $date = "08-09-2024";

        $cp_date = "08-12-2024";

        // thêm 1 ngày
        $add_date = Carbon::parse($date)->addDay()->format("d-m-Y");
        $add_dates = Carbon::parse($date)->addDays(10)->format("d-m-Y");

        // trừ 1 ngày
        $sub_date = Carbon::parse($date)->subDay()->format("d-m-Y");
        $sub_dates = Carbon::parse($date)->subDays(10)->format("d-m-Y");

        $this->info($add_date);
        $this->info($add_dates);

        $this->info($sub_date);
        $this->info($sub_dates);

        $date = Carbon::parse($date);
        $cp_date = Carbon::parse($cp_date);

        // so sánh thời gian
        dump($date->lessThanOrEqualTo($cp_date));
        dump($date->greaterThanOrEqualTo($cp_date));

        // lấy ra thời gian chênh lệch
        dump($cp_date->diff($date));

        dump($date->startOfMonth()->format("d-m-Y"));
        dump($date->endOfMonth()->format("d-m-Y"));


        dump($date->endOfMonth()->day);
        dump($date->endOfMonth()->month);
        dump($date->endOfMonth()->year);

    }
}
