<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Dompdf\Dompdf;
use Dompdf\FontMetrics; 
use Dompdf\Options;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $month_th = [
            1 => 'มกราคม',
            2 => 'กุมภาพันธ์',
            3 => 'มีนาคม',
            4 => 'เมษายน',
            5 => 'พฤษภาคม',
            6 => 'มิถุนายน',
            7 => 'กรกฎาคม',
            8 => 'สิงหาคม',
            9 => 'กันยายน',
            10 => 'ตุลาคม',
            11 => 'พฤศจิกายน',
            12 => 'ธันวาคม',
        ];

        $member = Member::find($id);

        $created_at = explode(' ', $member->created_at);
        $date = explode('-', $created_at[0]);
        $d = $date[2];
        $m = $month_th[intval($date[1])];
        $y = $date[0] + 543;

        $created = "$d $m $y";

        $options = new Options(); 
        $options->set('font_dir', storage_path('fonts/')); 
        $options->set('font_cache', storage_path('fonts/')); 
        $options->set('chroot', realpath(base_path())); 
        $options->set('enable_remote', true); 
        $options->set('enable_font_subsetting', false); 

        $dompdf = new Dompdf($options); 
        $html = view('pdf.contract', [
            'member' => $member,
            'created' => $created,
        ])->render();
        
        $dompdf->loadHTML($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render(); 
        $dompdf->add_info('Title', 'ใบสมัครสมาชิก/สัญญา');
        
        $canvas = $dompdf->getCanvas(); 
        $fontMetrics = new FontMetrics($canvas, $options); 
        $font = $fontMetrics->getFont('Sarabun'); 
        $text = "SOCIAL SECURITY PRIVATE FUND FOR SOCIAL WELFARE"; 
        $canvas->set_opacity(0.2); 
        $canvas->text(50, 600, $text, $font, 44, [0, 0, 0], 0.0, 0.0, -45); 
        
        // Output the generated PDF (1 = download and 0 = preview) 
        $dompdf->stream('ใบสมัครสมาชิก/สัญญา', array("Attachment" => 0));
    }
}
