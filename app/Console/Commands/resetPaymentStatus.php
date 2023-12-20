<?php

namespace App\Console\Commands;

use App\Helper\DatabaseHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\Payment;

class resetPaymentStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-payment-status';

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
        $now = DatabaseHelper::getNowMonth();

        $payments = Payment::where('langganan_berakhir', '<' , $now)->update(['status' => 'expired']);

        // foreach($payments as $item) {
        //     $item->update(['status' => 'expired']);
        // }

        $this->info('payments status updated successfully!');
    }
}
