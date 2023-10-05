<?php

namespace App\Console\Commands;

use App\Http\Traits\CommandsTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TruncateTable extends Command
{
    use CommandsTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'truncate:table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncates table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->askValid('Enter Table Name', 'name', ['required', 'string']);

        if(! Schema::hasTable($name))
        {
            $this->error("Table not Exists");
            return Command::FAILURE;
        }

        
        DB::table($name)->truncate();

        $this->info("success");
        return Command::SUCCESS;
    }
}
