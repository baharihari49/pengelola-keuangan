<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Anggaran;
use Illuminate\Support\Carbon;

class ResetAnggaran extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-anggaran';

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
        $now = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-d-m');

        $reset_anggaran = Anggaran::where('tanggal_mulai', '=', $now)->get();

        foreach($reset_anggaran as $rs) {
            $rs->update([
                'jumlah' => 0,
            ]);
        }

    }
}
