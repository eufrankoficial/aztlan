<?php

namespace App\Console\Commands;

use App\Jobs\SaveDataDeviceJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ReadDeviceTmpTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:read-device-tmp-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read device temporary table and creates jobs to records';

    /**
     * Create a new command instance.
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
        DB::table('device_tmp')->orderBy('created_at', 'asc')->chunk(100, function ($devices) {
            SaveDataDeviceJob::dispatch($devices);
        });
    }
}
