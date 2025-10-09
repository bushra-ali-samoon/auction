<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Auction;
use Carbon\Carbon;

class UpdateAuctionStatus extends Command
{
    protected $signature = 'auction:update-status';
    protected $description = 'Update auction status based on start and end times';

    
public function handle()
    {
        $now = Carbon::now();

        // Start pending auctions
        Auction::where('status', 'pending')
            ->where('auction_start', '<=', $now)
            ->update(['status' => 'started']);

        // Expire started auctions
        Auction::where('status', 'started')
            ->where('auction_end', '<=', $now)
            ->update(['status' => 'expired']);

        $this->info('Auction statuses updated successfully!');
    }

}
