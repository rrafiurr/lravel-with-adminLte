<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserTimeTransaction extends Model
{
    use HasFactory;
    protected $table = 'user_time_transactions';
    public function weeks(): HasOne
    {
        return $this->hasOne(Week::class, 'id', 'week_id');
    }
    public function transactions(): HasOne
    {
        return $this->hasOne(Transaction::class, 'id', 'transaction_id');
    }
}
