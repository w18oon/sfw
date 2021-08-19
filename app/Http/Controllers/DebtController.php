<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Dompdf\Dompdf;
use Dompdf\FontMetrics; 
use Dompdf\Options;

class DebtController extends Controller
{
    public function __invoke($id)
    {
        // get data by id
        $member = Member::findOrFail($id);

        // init option for pdf
        $options = new Options(); 
        $options->set('font_dir', storage_path('fonts/')); 
        $options->set('font_cache', storage_path('fonts/')); 
        $options->set('chroot', realpath(base_path())); 
        $options->set('enable_remote', true); 
        $options->set('enable_font_subsetting', false); 

        $dompdf = new Dompdf($options); 

        // prepaid data
        $member_title = ($member->title == 'อื่นๆ')? $member->other_title: $member->title;
        $member_name = $member_title . $member->firstname . ' ' . $member->lastname;
        $member_name_len = strlen($member_name) + (130 - floor(strlen($member_name)/3));

        $debts = [];
        $sum = [];
        foreach ($member->debts as $debt) {
            $debts[$debt->type][] = [
                'type' => $debt->type,
                'bank_name' => $debt->bank_name,
                'total_amount' => $debt->total_amount,
                'remaining_amount' => $debt->remaining_amount,
                'created_at' => $debt->created_at,
                'updated_at' => $debt->updated_at,
                'bank_branch' => $debt->bank_branch,
                'contact' => $debt->contact,
                'contract_no' => $debt->contract_no,
                'contract_date' => $debt->contract_date,
                'status' => $debt->status,
                'other_status' => $debt->other_status,
                'date_1' => $debt->date_1,
                'date_2' => $debt->date_2,
                'interest' => $debt->interest,
            ];
            $sum[$debt->type]['total'] = isset($sum[$debt->type]['total'])? ($sum[$debt->type]['total'] + $debt->total_amount) : $debt->total_amount;
            $sum[$debt->type]['remaining'] = isset($sum[$debt->type]['remaining'])? ($sum[$debt->type]['remaining'] + $debt->remaining_amount): $debt->remaining_amount;
        }

        $net_total = array_reduce($sum, function($carry, $item) {
            return $carry += $item['total'];
        });

        $net_remaining = array_reduce($sum, function($carry, $item) {
            return $carry += $item['remaining'];
        });

        $html = view('pdf.debt', [
            'member' => $member,
            'member_name' => $member_name,
            'member_name_len' => $member_name_len,
            'debts' => $debts,
            'sum' => $sum,
            'net_total' => $net_total,
            'net_remaining' => $net_remaining,
        ])->render();
        
        $dompdf->loadHTML($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render(); 
        $dompdf->add_info('Title', 'ใบแสดงรายการหนี้สิน');
        
        $canvas = $dompdf->getCanvas(); 

        $fontMetrics = new FontMetrics($canvas, $options); 
        $font = $fontMetrics->getFont('Sarabun'); 
        $canvas->page_text(60, 600, 'SOCIAL SECURITY PRIVATE FUND FOR SOCIAL WELFARE', $font, 44, [.8,.8,.8], 0.0, 0.0, -45); 
        
        // response output as file downloads
        $dompdf->stream('ใบแสดงรายการหนี้สิน', array('Attachment' => 0));
    }
}
