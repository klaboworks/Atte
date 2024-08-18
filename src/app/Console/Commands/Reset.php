<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Attendance;
use App\Models\Rest;
use Carbon\Carbon;

class Reset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resrt attendances';

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
     * @return int
     */
    public function handle()
    {
        $attends = Attendance::where('date', Carbon::today())->get();

        foreach ($attends as $attend) {
            if (empty($attend->end_work)) {
                $attend->update(['end_work' => Carbon::today()->endOfDay()]);
            }
            $rests = Rest::where('attendances_id', $attend->id)->get();
            foreach ($rests as $rest) {
                if (empty($rest->end_rest)) {
                    $rest->update(['end_rest' => Carbon::today()->endOfDay()]);
                }
            }
        }
    }
}
