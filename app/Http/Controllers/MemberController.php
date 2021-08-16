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
        $q_status = $request->input('q_status')? $request->input('q_status'): '';

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
            if($request->input('q_status')) {
                $query->where('status', '=', $request->input('q_status'))->get();
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
            'q_status' => $q_status,
            'status_list' => ['รอดำเนินการ', 'ปกติ', 'พ้นสภาพ'],
            'updated_by' => auth()->user()->name,
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
                'benef_fax')
            );

            foreach($request->input('docs') as $doc) {
                $member->document()->create([
                    'name' => $doc['name'],
                    'desc' => $doc['desc'],
                ]);
            }

            foreach($request->input('debt_type_1_dtl') as $dtl) {
                $member->debt()->create([
                    'type' => 1,
                    'bank_name' => $dtl['bank_name'],
                    'total_amount' => $dtl['total_amount'],
                    'remaining_amount' => $dtl['remaining_amount'],
                    'bank_branch' => $dtl['bank_branch'],
                    'contact' => $dtl['contact'],
                    'contract_no' => $dtl['contract_no'],
                    'contract_date' => $dtl['contract_date'],
                    'status' => $dtl['status'],
                    'other_status' => $dtl['other_status'],
                    'date_1' => $dtl['date_1'],
                    'date_2' => $dtl['date_2'],
                    'interest' => $dtl['interest'],
                ]);
            }

            foreach($request->input('debt_type_2_dtl') as $dtl) {
                $member->debt()->create([
                    'type' => 2,
                    'bank_name' => $dtl['bank_name'],
                    'total_amount' => $dtl['total_amount'],
                    'remaining_amount' => $dtl['remaining_amount'],
                    'bank_branch' => $dtl['bank_branch'],
                    'contact' => $dtl['contact'],
                    'contract_no' => $dtl['contract_no'],
                    'contract_date' => $dtl['contract_date'],
                    'status' => $dtl['status'],
                    'other_status' => $dtl['other_status'],
                    'date_1' => $dtl['date_1'],
                    'date_2' => $dtl['date_2'],
                    'interest' => $dtl['interest'],
                ]);
            }

            foreach($request->input('debt_type_3_dtl') as $dtl) {
                $member->debt()->create([
                    'type' => 3,
                    'bank_name' => $dtl['bank_name'],
                    'total_amount' => $dtl['total_amount'],
                    'remaining_amount' => $dtl['remaining_amount'],
                    'bank_branch' => $dtl['bank_branch'],
                    'contact' => $dtl['contact'],
                    'contract_no' => $dtl['contract_no'],
                    'contract_date' => $dtl['contract_date'],
                    'status' => $dtl['status'],
                    'other_status' => $dtl['other_status'],
                    'date_1' => $dtl['date_1'],
                    'date_2' => $dtl['date_2'],
                    'interest' => $dtl['interest'],
                ]);
            }

            foreach($request->input('debt_type_4_dtl') as $dtl) {
                $member->debt()->create([
                    'type' => 4,
                    'bank_name' => $dtl['bank_name'],
                    'total_amount' => $dtl['total_amount'],
                    'remaining_amount' => $dtl['remaining_amount'],
                    'bank_branch' => $dtl['bank_branch'],
                    'contact' => $dtl['contact'],
                    'contract_no' => $dtl['contract_no'],
                    'contract_date' => $dtl['contract_date'],
                    'status' => $dtl['status'],
                    'other_status' => $dtl['other_status'],
                    'date_1' => $dtl['date_1'],
                    'date_2' => $dtl['date_2'],
                    'interest' => $dtl['interest'],
                ]);
            }

            return response()->json(['member_id' => $member->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e]);
        }
    }

    public function show($id)
    {
        return view('members.show', [
            'member' => Member::find($id),
        ]);
    }

    public function edit($id)
    {
        return view('members.edit', [
            'postcodes' => Postcode::orderBy('province')->get(),
            'member' => Member::find($id),
            'updated_by' => auth()->user()->name,
        ]);
    }

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

    public function update_status(Request $request, $id)
    {
        $member = Member::find($id);
        try {
            $member->update($request->only('status', 'updated_by'));
            return response()->json(['member' => $member]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e]);
        }
    }

    public function destroy($id)
    {
        $member = Member::find($id);
        $member_no = $member->no;
        $member->delete();
        return redirect()->route('member.index')->with('success', "ลบข้อมูลสมาชิกเลขที่ $member_no เรียบร้อยแล้วครับ");
    }
}
