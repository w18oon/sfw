<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $npls = ['หนี้สินในระบบแบบถูกกฏหมาย', 'หนี้สินนอกระบบแบบถูกกฏหมาย', 'หนี้สินนอกระบบแบบผิดกฏหมาย', 'หนี้สินแบบสหกรณ์'];
        $csv_file = auth()->user()->name . date('_Ymd_His') . '.csv';

        if ($request->input('report_type') == 'summary') {
            $items = DB::table('members')
                        ->join('provinces', function($join) use ($request) {
                            $join->on('provinces.name_th', '=', 'members.receipt_province');
                            if ($request->input('q_region') != 'all') {
                                $join->where('region_name_th', '=', $request->input('q_region'));
                            }
                            if ($request->input('q_province') != 'all') {
                                $join->where('name_th', '=', $request->input('q_province'));
                            }
                        })
                        ->join('debts', function($join) use ($request) {
                            $join->on('debts.member_id', '=', 'members.id');
                            if ($request->input('q_npl') != 'all') {
                                $join->where('type', '=', $request->input('q_npl'));
                            }
                            if ($request->input('q_bank') != 'all') {
                                $join->where('bank_name', '=', $request->input('q_bank'));
                            }
                        })
                        ->where(function($query) use ($request) {
                            if ($request->input('q_date_from')) {
                                $query->where('members.created_at', '>=', $request->input('q_date_from'))->get();
                            }
                            if ($request->input('q_date_to')) {
                                $query->where('members.created_at', '<=', $request->input('q_date_to'))->get();
                            }
                            if ($request->input('q_age_from')) {
                                $query->where('age', '>=', $request->input('q_age_from'))->get();
                            }
                            if ($request->input('q_age_to')) {
                                $query->where('age', '<=', $request->input('q_age_to'))->get();
                            }
                        })
                        ->select('provinces.region_name_th', 'provinces.name_th', 'debts.type', DB::raw('count(distinct members.id) as total_member'), DB::raw('sum(debts.remaining_amount) as sum_remaining_amount'))
                        ->groupBy('provinces.region_name_th', 'provinces.name_th', 'debts.type')
                        ->get();
            $file = fopen("storage/reports/$csv_file", 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, ['ภาค', 'จังหวัด', 'จำนวนสมากชิก	', 'หนี้	', 'ยอดรวม']);
            foreach ($items as $item) {
                fputcsv($file, [$item->region_name_th, $item->name_th, $item->total_member, $npls[$item->type - 1], $item->sum_remaining_amount]);
            }
            fclose($file);
        } else {
            $items = DB::table('members')
                        ->join('provinces', function($join) use ($request) {
                            $join->on('provinces.name_th', '=', 'members.receipt_province');
                            if ($request->input('q_region') != 'all') {
                                $join->where('region_name_th', '=', $request->input('q_region'));
                            }
                            if ($request->input('q_province') != 'all') {
                                $join->where('name_th', '=', $request->input('q_province'));
                            }
                        })
                        ->join('debts', function($join) use ($request) {
                            $join->on('debts.member_id', '=', 'members.id');
                            if ($request->input('q_npl') != 'all') {
                                $join->where('type', '=', $request->input('q_npl'));
                            }
                            if ($request->input('q_bank') != 'all') {
                                $join->where('bank_name', '=', $request->input('q_bank'));
                            }
                        })
                        ->where(function($query) use ($request) {
                            if ($request->input('q_date_from')) {
                                $query->where('members.created_at', '>=', $request->input('q_date_from'))->get();
                            }
                            if ($request->input('q_date_to')) {
                                $query->where('members.created_at', '<=', $request->input('q_date_to'))->get();
                            }
                            if ($request->input('q_age_from')) {
                                $query->where('age', '>=', $request->input('q_age_from'))->get();
                            }
                            if ($request->input('q_age_to')) {
                                $query->where('age', '<=', $request->input('q_age_to'))->get();
                            }
                        })
                        ->select('members.no', 'members.id_card_no', 'members.firstname', 'members.lastname', 'members.mobile', 'members.receipt_province', 'members.created_at', 'provinces.region_name_th', 'members.age', 'debts.type', 'debts.bank_name', 'debts.remaining_amount')
                        ->get();
            $file = fopen("storage/reports/$csv_file", 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, ['เลขที่สมาชิก', 'เลขที่บัตรประจำตัวประชาชน', 'ชื่อ', 'นามสกุล', 'เบอร์โทรศัพท์', 'ภูมิภาค', 'สังกัดจังหวัด', 'วันที่สมัครสมาชิก', 'อายุ', 'หนี้', 'สถาบันการเงิน', 'จำนวนหนี้คงเหลือ']);
            foreach ($items as $item) {
                fputcsv($file, [
                    $item->no, 
                    $item->id_card_no, 
                    $item->firstname, 
                    $item->lastname, 
                    $item->mobile, 
                    $item->region_name_th, 
                    $item->receipt_province,
                    $item->created_at,
                    $item->age,
                    $npls[$item->type - 1],
                    $item->bank_name,
                    $item->remaining_amount,
                ]);
            }
            fclose($file);
        }

        return view('reports.index', [
            'regions' => ['กลาง', 'ตะวันออกเฉียงเหนือ', 'เหนือ', 'ใต้'],
            'provinces' => Province::orderBy('name_th')->get(),
            'banks' => ['ธนาคารกรุงเทพ', 'ธนาคารกสิกรไทย', 'ธนาคารกรุงไทย', 'ธนาคารทหารไทยธนชาต', 'ธนาคารไทยพาณิชย์', 'ธนาคารกรุงศรีอยุธยา', 'ธนาคารเกียรตินาคินภัทร', 'ธนาคารซีไอเอ็มบีไทย', 'ธนาคารทิสโก้', 'ธนาคารยูโอบี', 'ธนาคารไทยเครดิตเพื่อรายย่อย', 'ธนาคารแลนด์ แอนด์ เฮ้าส์', 'ธนาคารไอซีบีซี (ไทย)', 'ธนาคารพัฒนาวิสาหกิจขนาดกลางและขนาดย่อมแห่งประเทศไทย', 'ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร', 'ธนาคารเพื่อการส่งออกและนำเข้าแห่งประเทศไทย', 'ธนาคารออมสิน', 'ธนาคารอาคารสงเคราะห์', 'ธนาคารอิสลามแห่งประเทศไทย'],
            'npls' => $npls,
            'q_region' => $request->input('q_region')? $request->input('q_region'): '',
            'q_province' => $request->input('q_province')? $request->input('q_province'): '',
            'q_date_from' => $request->input('q_date_from')? $request->input('q_date_from'): '',
            'q_date_to' => $request->input('q_date_to')? $request->input('q_date_to'): '',
            'q_age_from' => $request->input('q_age_from')? $request->input('q_age_from'): '',
            'q_age_to' => $request->input('q_age_to')? $request->input('q_age_to'): '',
            'q_npl' => $request->input('q_npl')? $request->input('q_npl'): '',
            'q_bank' => $request->input('q_bank')? $request->input('q_bank'): '',
            'report_type' => $request->input('report_type')? $request->input('report_type'): '',
            'items' => $items,
            'csv_file' => $csv_file,
        ]);
    }
}
