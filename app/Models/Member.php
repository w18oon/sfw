<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'no',
        'receipt_province',
        'field_1_1',
        'field_1_2',
        'field_1_3',
        'field_1_4',
        'field_1_5',
        'field_1_6',
        'field_1_7',
        'field_1_8',
        'field_1_9',
        'field_1_10',
        'field_1_11',
        'field_1_12',
        'field_1_13',
        'field_1_14',
        'field_1_15',
        'field_1_16',
        'field_1_17',
        'field_1_18',
        'field_1_19',
        'field_1_20',
        'field_1_21',
        'field_1_22',
        'field_1_23',
        'field_1_24',
        'field_1_25',
        'field_1_26',
        'field_1_27',
        'field_1_28',
        'field_1_29',
        'field_1_30',
        'field_1_31',
        'field_1_32',
        'field_1_33',
        'field_1_34',
        'field_1_35',
        'field_1_36',
        'field_1_37',
        'field_1_38',
        'field_1_39',
        'field_1_40',
        'field_1_41',
        'field_1_42',
        'field_1_43',
        'field_1_44',
        'field_1_45',
        'field_1_46',
        'field_1_47',
        'field_1_48',
        'field_1_49',
        'field_1_50',
        'field_2_1',
        'field_2_2',
        'field_2_3',
        'field_2_4',
        'field_2_5',
        'field_2_6',
        'field_3_1',
        'field_4_1',
        'field_4_2',
        'field_4_3',
        'field_4_4',
        'field_4_5',
        'field_4_6',
        'field_4_7',
        'field_4_8',
        'field_4_9',
        'field_4_10',
        'field_4_11',
        'field_4_12',
        'field_4_13',
        'field_4_14',
        'field_4_15',
        'field_4_16',
        'field_4_17',
        'field_5_1',
        'field_5_2',
        'field_5_3',
        'field_5_4',
        'field_5_5',
        'field_5_6',
        'field_5_7',
        'field_5_8',
        'field_5_9',
        'field_5_10',
        'field_5_11',
        'field_5_12',
        'field_5_13',
        'field_5_14',
        'field_5_15',
    ];

    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }

    protected static function booted()
    {
        static::created(function ($member) {
            $province = Province::where('name_th', $member->receipt_province)->first();
            $config = Config::where('type', 'member_no')->where('name', $province->region_code)->first();
            $no = $config->value + 1;
            $config->value = $no;
            $config->save();
            $thai_year = date('Y') + 543;
            $member->no = substr($thai_year, 2, 2) . $config->name . str_pad($no, 6, 0, STR_PAD_LEFT);
            $member->save();
        });
    }
}
