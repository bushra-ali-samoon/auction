<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
 
class Auction extends Model
{
    protected $fillable = ['title', 'starting_price', 'auction_start', 'auction_end', 'user_id', 'status'];

        public function bids()
{
    return $this->hasMany(Bid::class);
}
 
public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
// public function currentStatus()
// {
//     $now = Carbon::now();

//     // If dates are not set
//     if (!$this->auction_start || !$this->auction_end) {
//         return 'pending';
//     }

//     if ($now->lt($this->auction_start)) {
//         return 'Not Started';
//     } elseif ($now->between($this->auction_start, $this->auction_end)) {
//         return 'Ongoing';
//     } else {
//         return 'Expired';
//     }
// }


}
 