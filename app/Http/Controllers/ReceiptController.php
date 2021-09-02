<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Member;
use App\Models\Province;
use Dompdf\Dompdf;
use Dompdf\FontMetrics; 
use Dompdf\Options;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

        if ($member->status == 'รอดำเนินการ') {
            abort(403);
        }

        if(!$member->receipt) {
            $config = Config::where('type', 'receipt_no')->where('name', $member->receipt_province)->first();

            if($config) {
                $no = $config->value + 1;
                $config->value = $no;
                $config->save();
            } else {
                $no = 1;
                $config = new Config();
                $config->type = 'receipt_no';
                $config->name = $member->receipt_province;
                $config->value = $no;
                $config->save();
            }

            $abbr_en = Province::where('name_th', $member->receipt_province)->first()->abbr_en;

            $book = floor($no/100) + 1;

            $no = ($no%100 == 0)? 100: $no;

            $receipt_no = $abbr_en . str_pad($no, 3, '0', STR_PAD_LEFT);

            $member->receipt()->create([
                'book' => $book,
                'no' => $receipt_no,
            ]);
        } else {
            $book = $member->receipt->book;
            $receipt_no = $member->receipt->no;
        }
        // echo "Book " . $book;
        // echo "No " . $receipt_no;

        $created_at = explode(' ', $member->created_at);
        $receipt_date = explode('-', $created_at[0]);

        // $yy = date('Y');
        $yy = substr($receipt_date[0] + 543, 2);
        $receipt = "$book-$receipt_no-$yy.pdf";

        $options = new Options(); 
        $options->set('font_dir', storage_path('fonts/')); 
        $options->set('font_cache', storage_path('fonts/')); 
        $options->set('chroot', realpath(base_path())); 
        $options->set('enable_remote', true); 
        $options->set('enable_font_subsetting', false); 

        $name = "$member->firstname $member->lastname";
        $name_length = strlen($name) + 30;

        $id_card_no_length = strlen($member->id_card_no) + 30;

        $province_length = strlen($member->receipt_province) + 30;

        $mobile_length = strlen($member->mobile) + 30;

        $dompdf = new Dompdf($options); 
        $html = view('pdf.receipt', [
            'member' => $member,
            'book' => $book,
            'receipt_no' => $receipt_no,
            'yy' => $yy,
            'd' => $receipt_date[2],
            'm' => $month_th[intval($receipt_date[1])],
            'y' => $receipt_date[0] + 543,
            'name' => $name,
            'name_length' => $name_length,
            'id_card_no_length' => $id_card_no_length,
            'province_length' => $province_length,
            'mobile_length' => $mobile_length,
        ])->render();
        $dompdf->loadHTML($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render(); 
        $dompdf->add_info('Title', $receipt);
        
        $canvas = $dompdf->getCanvas(); 
        
        $fontMetrics = new FontMetrics($canvas, $options); 
        
        // $w = $canvas->get_width(); 
        // $h = $canvas->get_height(); 
        
        $font = $fontMetrics->getFont('Sarabun'); 
        
        $text = "SOCIAL SECURITY PRIVATE FUND FOR SOCIAL WELFARE"; 
        
        // $txtHeight = $fontMetrics->getFontHeight($font, 30); 
        // $textWidth = $fontMetrics->getTextWidth($text, $font, 30); 
        
        $canvas->set_opacity(0.2); 
        
        $canvas->text(50, 600, $text, $font, 44, [0, 0, 0], 0.0, 0.0, -45); 
        
        // Output the generated PDF (1 = download and 0 = preview) 
        $dompdf->stream($receipt, array("Attachment" => 0));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
