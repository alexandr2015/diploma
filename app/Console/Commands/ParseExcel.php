<?php

namespace App\Console\Commands;

use App\Models\Response;
use App\Models\Student;
use Illuminate\Console\Command;

class ParseExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:excel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file = storage_path('files/1111.csv');
        $fileData = array_map('str_getcsv', file($file));
        unset($fileData[0]);
        $count = 0;
        foreach ($fileData as $item) {
            $student = Student::where('first_name', $item[10])->where('last_name', $item[9])->first();
            if (is_null($student)) {
                $student = Student::create([
                    'first_name' => $item[10],
                    'last_name' => $item[9],
                ]);
            }
            $student->responses()->create([
                'now_a' => $item[1],
                'now_b' => $item[2],
                'now_c' => $item[3],
                'now_d' => $item[4],
                'future_a' => $item[5],
                'future_b' => $item[6],
                'future_c' => $item[7],
                'future_d' => $item[8],
                'question_id' => $item[0],
            ]);

            echo "count - " . $count++ . "\n";
        }
    }
}
