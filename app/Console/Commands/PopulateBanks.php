<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Bank;
use App\Services\Request\Paystack;

class PopulateBanks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:banks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate the bank table';

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
        if (Bank::count() < 10) {
            $paystack = new Paystack();
            $response = $paystack->bankList();
            $banks = $response->data;
            foreach ($banks as $bank){
                Bank::create([
                    'name' => $bank->name,
                    'code' => $bank->code
                ]);

            }
        }
        $this->info('Bank table populated successfully');
    }
}
