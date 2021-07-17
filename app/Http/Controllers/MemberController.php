<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Postcode;
use App\Models\Province;

class MemberController extends Controller
{

    public function index(Request $request)
    {   
        $no = $request->input('no')? $request->input('no'): '';
        $id_card_no = $request->input('id_card_no')? $request->input('id_card_no'): '';
        $receipt_province = $request->input('receipt_province')? $request->input('receipt_province'): '';
        $date_from = $request->input('date_from')? $request->input('date_from'): '';
        $date_to = $request->input('date_to')? $request->input('date_to'): '';

        $members = Member::where(function($query) use ($request) {
            if($request->input('no')) {
                $query->where('no', '=', $request->input('no'))->get();
            }
            if($request->input('id_card_no')) {
                $query->where('id_card_no', '=', $request->input('id_card_no'))->get();
            }
            if($request->input('receipt_province')) {
                $query->where('receipt_province', '=', $request->input('receipt_province'))->get();
            }
            if($request->input('date_from')) {
                $query->where('created_at', '>=', $request->input('date_from'))->get();
            }
            if($request->input('date_to')) {
                $query->where('created_at', '<=', $request->input('date_to'))->get();
            }
        })->paginate(20);

        // $members = Member::paginate(20);
        return view('members.index', [
            'provinces' => Province::orderBy('name_th')->get(),
            'members' => $members,
            'no' => $no,
            'id_card_no' => $id_card_no,
            'receipt_province' => $receipt_province,
            'date_from' => $date_from,
            'date_to' => $date_to,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $member = Member::create($request->only('title',
            'other_title',
            'firstname',
            'lastname',
            'receipt_province',
            'id_card_no',
            'emp_card_no',
            'exp_date',
            'age',
            'nationality',
            'mobile',
            'is_bankrupt',
            'is_incompetent_person',
            'is_permanent_disability',
            'is_quasi_incompetent_person',
            'marital_status',
            'number_of_children',
            'number_of_children_study',
            'spouse_title',
            'other_spouse_title',
            'spouse_firstname',
            'spouse_lastname',
            'spouse_id_card_no',
            'house_no',
            'moo',
            'soi',
            'street',
            'sub_district',
            'district',
            'province',
            'post_code',
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
            'career',
            'other_career',
            'income_type',
            'income_amount',
            'other_income_type',
            'other_income',
            'other_income_amount',
            'source_other_income',
            'debt_type_1',
            'debt_type_2',
            'debt_type_3',
            'debt_type_4',
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
            'benef_fax'));
            return response()->json(['member_id' => $member->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('members.edit', [
            'postcodes' => Postcode::orderBy('province')->get(),
            'member' => Member::find($id),
            'updated_by' => auth()->user()->name,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $member = Member::find($id);
        try {
            $member->update($request->only('title',
            'other_title',
            'firstname',
            'lastname',
            'receipt_province',
            'id_card_no',
            'emp_card_no',
            'exp_date',
            'age',
            'nationality',
            'mobile',
            'is_bankrupt',
            'is_incompetent_person',
            'is_permanent_disability',
            'is_quasi_incompetent_person',
            'marital_status',
            'number_of_children',
            'number_of_children_study',
            'spouse_title',
            'other_spouse_title',
            'spouse_firstname',
            'spouse_lastname',
            'spouse_id_card_no',
            'house_no',
            'moo',
            'soi',
            'street',
            'sub_district',
            'district',
            'province',
            'post_code',
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
            'career',
            'other_career',
            'income_type',
            'income_amount',
            'other_income_type',
            'other_income',
            'other_income_amount',
            'source_other_income',
            'debt_type_1',
            'debt_type_2',
            'debt_type_3',
            'debt_type_4',
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
            'updated_by'));
            // $member->updated_by = auth()->user()->name;
            // $member->save();
            return response()->json(['member' => $member]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $member_no = $member->no;
        $member->delete();
        return redirect()->route('member.index')->with('success', "ลบข้อมูลสมาชิกเลขที่ $member_no เรียบร้อยแล้วครับ");
    }
}
