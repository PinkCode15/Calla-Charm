<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\AuthSetting;

class AddAuthSetting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:auth-setting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds Auth Setting';

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
        if (AuthSetting::count() < 1) {
            AuthSetting::create([
                'guard' => 'web'
            ]);
        }
        

        $this->info('Auth Setting added');
    }
}
