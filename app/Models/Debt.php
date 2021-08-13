<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'bank_name', 'total_amount', 'remaining_amount', 'bank_branch', 'contact', 'contract_no', 'contract_date', 'status', 'other_status', 'date_1', 'date_2', 'interest'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
