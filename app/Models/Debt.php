<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'desc', 'total_amount', 'remaining_amount'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
