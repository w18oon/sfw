<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'firstname',
        'lastname',
        'house_no',
        'moo',
        'street',
        'sub_district',
        'district',
        'province',
        'post_code',
        'id_card_no',
        'mobile',
        'career',
        'debt_in_credit_bureau',
        'debt_out_credit_bureau',
        'informal_debt',
        'total',
        'saving_per_month',
        'remarks',
        'receipt_province',
        'status',
        'updated_by',
        'other_title',
        'soi',
        'other_career',
        'emp_card_no',
        'exp_date',
        'age',
        'nationality',
        'is_bankrupt',
        'is_incompetent_person',
        'is_permanent_disability',
        'is_quasi_incompetent_person',
        'marital_status',
        'number_of_children',
        'number_of_children_study',
        'spouse_title',
        'spouse_firstname',
        'spouse_lastname',
        'spouse_id_card_no',
        'other_spouse_title',
        'tel',
        'fax',
        'mail',
        'ship_house_no',
        'ship_moo',
        'ship_soi',
        'ship_street',
        'ship_sub_district',
        'ship_district',
        'ship_province',
        'ship_postcode',
        'ship_tel',
        'ship_mail',
        'ship_line',
        'ship_fb',
        'house_type',
        'cost_per_month',
        'house_year',
        'education_level',
        'other_education_level',
        'income_type',
        'income_amount',
        'other_income_type',
        'other_income',
        'other_income_amount',
        'source_other_income',
        'debt_type',
        'workplace',
        'building',
        'floor',
        'department',
        'workplace_no',
        'workplace_moo',
        'workplace_soi',
        'workplace_street',
        'workplace_sub_district',
        'workplace_district',
        'workplace_province',
        'workplace_postcode',
        'workplace_tel',
        'workplace_fax',
        'work_exp',
        'job_position',
        'old_workplace',
        'benef_title',
        'benef_other_title',
        'benef_firstname',
        'benef_lastname',
        'benef_id_card_no',
        'benef_relationship',
        'benef_house_no',
        'benef_moo',
        'benef_soi',
        'benef_street',
        'benef_sub_district',
        'benef_district',
        'benef_province',
        'benef_postcode',
        'benef_tel',
        'benef_fax',
    ];

    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }

    // protected static function booted()
    // {
    //     static::created(function ($member) {
    //         $province = Province::where('name_th', $member->receipt_province)->first();
    //         $config = Config::where('type', 'member_no')->where('name', $province->region_code)->first();
    //         $no = $config->value + 1;
    //         $config->value = $no;
    //         $config->save();
    //         $thai_year = date('Y') + 543;
    //         $member->no = substr($thai_year, 2, 2) . $config->name . str_pad($no, 6, 0, STR_PAD_LEFT);
    //         $member->save();
    //     });
    // }
}
