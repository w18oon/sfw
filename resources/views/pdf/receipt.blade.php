<!DOCTYPE html>
<html lang="en">
<header>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;700&display=swap" rel="stylesheet"> --}}
    <title>pdf</title>
    <style>
        @font-face {
            font-family: 'Sarabun';
            font-style: normal;
            font-weight: normal;
            src: url("{{ storage_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'Sarabun';
            font-style: normal;
            font-weight: bold;
            src: url("{{ storage_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'Sarabun';
            font-style: normal;
            font-weight: bold;
            src: url("{{ storage_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
        html { margin: 30px; }
        body { font-family: 'Sarabun', sans-serif; font-size: 16pt; line-height: normal; }
        table { width: 100%; }
        th, td { padding: 0; }
        table.table-border, 
        table.table-border th, 
        table.table-border td { border: 1px solid black; border-collapse: collapse; }
        table.table-border th, 
        table.table-border td { padding: 0 .5rem; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>
</header>
<body>
    <table>
        <tbody>
            <tr>
                <td style="width: 20%; vertical-align: bottom;">เล่มที่{{ Str::padLeft($book, 3, 0) }}</td>
                <td style="width: 60%; text-align: center;"><img style="width: 200px;" src="{{ public_path('logo.png') }}"/></td>
                <td style="width: 20%; vertical-align: bottom;">เลขที่ {{ $receipt_no . '/' . $yy }}</td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: center"><u>ใบเสร็จรับเงิน</u></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <div style="text-align: right">วันที่ {{ $d }} เดือน {{ $m }} พ.ศ. {{ $y }}</div>
    <p>ได้รับเงินจาก{{ Str::padBoth($name, $name_length, '.') }}เลขที่บัตรประจำตัวประชาชน{{ Str::padBoth($member->id_card_no, $id_card_no_length, '.') }}<br>จังหวัด{{ Str::padBoth($member->province, $province_length, '.') }}โทรศัพท์{{ Str::padBoth($member->mobile, $mobile_length, '.') }}</p>
    <table class="table-border">
        <thead>
            <tr>
                <th style="width: 20%">ลำดับที่</th>
                <th style="width: 60%">รายการ</th>
                <th style="width: 20%">จำนวนเงิน</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">1.</td>
                <td>ค่าสมัครแรกเข้าสมาชิกกองทุนอิสระฯ</td>
                <td class="text-right">500</td>
            </tr>
            <tr>
                <td class="text-center">2.</td>
                <td>ค่าบำรุงรายปีสมาชิกกองทุนอิสระฯ</td>
                <td class="text-right">2,000</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-center"><strong>รวม</strong></td>
                <td class="text-right">2,500</td>
            </tr>
        </tbody>
    </table>
    <p>จำนวนเงิน (ตัวอักษร) ({{ Str::padBoth('สองพันห้าร้อยบาทถ้วน', 100, '.') }})</p>
    <table>
        <tbody>
            <tr>
                <td>ลงชื่อ{{ Str::padBoth('..', 40, '.') }} ผู้จ่ายเงิน</td>
                <td style="width: 10%"></td>
                <td>ลงชื่อ{{ Str::padBoth('..', 40, '.') }} ผู้ตรวจสอบ</td>
            </tr>
            <tr>
                <td>({{ Str::padBoth('..', 66, '.') }})</td>
                <td></td>
                <td>({{ Str::padBoth('..', 66, '.') }})</td>
            </tr>
            <tr>
                <td>สมาชิกเลขที่{{ Str::padBoth('..', 45, '.') }}</td>
                <td></td>
                <td>เหรัญญิกจังหวัด{{ Str::padBoth('..', 45, '.') }}</td>
            </tr>
            <tr>
                <td colspan="3"><br></td>
            </tr>
            <tr>
                <td>ลงชื่อ{{ Str::padBoth('..', 40, '.') }} ผู้ตรวจสอบ</td>
                <td></td>
                <td>ลงชื่อ{{ Str::padBoth('..', 40, '.') }} ผู้รับเงิน</td>
            </tr>
            <tr>
                <td style="padding-left: 30pt;">(นายนรากร ทานา)</td>
                <td></td>
                <td style="padding-left: 30pt;">(นายณัชภณ วงส์วิเศษ)</td>
            </tr>
            <tr>
                <td>เจ้าหน้าที่การเงินกองทุนอิสระสวัสดิการสงเคราะห์<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สัจจะออมทรัพย์เพื่อสวัสดิการสังคม</td>
                <td></td>
                <td>ประธานกองทุนอิสระสวัสดิการสงเคราะห์<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สัจจะออมทรัพย์เพื่อสวัสดิการสังคม</td>
            </tr>
        </tbody>
    </table>
    <div class="text-center" style="margin-top: 1rem">ธนาคาร ไทยพาณิชย์ จำกัด (มหาชน) สาขา บางนาทาวเวอร์</div>
    <div class="text-center">ชื่อบัญชี หสม.กองทุนอิสระสวัสดิการสงเคราะห์สัจจะออมทรัพย์เพื่อสวัสดิการสังคม</div>
    <div class="text-center">ประเภทบัญชี กระแสรายวัน / เดินสะพัด เลขที่บัญชี 331-303093-8</div>
</body>
</html>