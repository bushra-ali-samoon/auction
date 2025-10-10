<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Auction;
use Carbon\Carbon;

class UpdateAuctionStatus extends Command
{
    // Command signature => command that is change the status 
    protected $signature = 'auctions:update-status';

    // Command description
    protected $description = 'Update auction status based on start and end times';

        public function handle()
    {
        $now = Carbon::now();

        // Pending → Started
        Auction::where('status', 'pending')
            ->whereNotNull('auction_start')
            ->where('auction_start', '<=', $now)
            ->update(['status' => 'started']);

        // Started → Expired
        Auction::where('status', 'started')
            ->whereNotNull('auction_end')
            ->where('auction_end', '<=', $now)
            ->update(['status' => 'expired']);

        $this->info('Auction statuses updated successfully!');
    }

}
