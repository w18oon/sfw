<!DOCTYPE html>
<html lang="en">
<header>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบแสดงรายการหนี้สิน</title>
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
        html { margin: 1.5cm; }
        body { font-family: 'Sarabun', sans-serif; font-size: 16pt; line-height: 100%;  }
        th, td { padding: 0; }
        
        input[type=radio] { margin-left: 1rem; }
        input[type=checkbox] { margin-left: 1rem; }
    </style>
</header>
<body>
    <table style="width: 100%; margin: 0;">
        <tbody>
            <tr>
                <td colspan="3" style="text-align: center;"><strong>{{ __('บัญชีแสดงรายการหนี้สิน') }}</strong></td>
            </tr>
            <tr>
                <td style="width: 10%"></td>
                <td style="width: 60%"></td>
                <td style="width: 30%">
                    <table style="border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td colspan="13" style="text-align: center;"><strong>{{ __('เลขที่บัตรประชาชน') }}</strong></td>
                            </tr>
                            <tr>
                                @foreach (str_split($member->id_card_no) as $char)
                                    <td style="border: 1px solid black; padding: 0 0.25rem;">{{ $char }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width: 10%; vertical-align: top;">
                    <strong>{{ __('ผู้ยื่น'); }}</strong>
                </td>
                <td colspan="2" style="width: 90%">
                    <div>{{ __('ชื่อและชื่อสกุล ') . Str::padBoth($member_name, $member_name_len, '.') }}</div>
                    <div>{{ __('ชื่อและชื่อสกุลเดิม (ถ้ามี) ') . Str::padBoth('', 135, '.') }}</div>
                    <div>{{ __('อายุ') . Str::padBoth($member->age, 16, '.') . __('ปี') }}</div>
                    <div>
                        {{ __('สถานภาพ'); }}
                        @foreach (['โสด', 'หย่า', 'สมรสจดทะเบียน', 'สมรสไม่จดทะเบียน','หม้าย'] as $status)
                            <input type="checkbox" {{ $status == $member->marital_status? 'checked' :'' }}/>
                            <label> {{ $status }}</label>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 10%; vertical-align: top;">
                    <strong>{{ __('ที่อยู่'); }}</strong>
                </td>
                <td colspan="2" style="width: 90%">
                    <div>
                        <span>{{ __('บ้านเลขที่ ') . Str::padBoth($member->house_no, 16, '.') }}</span> 
                        <span>{{ __('หมู่ที่ ') . Str::padBoth($member->moo, 16, '.') }}</span>
                        <span>{{ __('ซอย ') . Str::padBoth($member->soi, 50 - floor(strlen($member->soi)/3), '.') }}</span>
                        <span>{{ __('ถนน ') . Str::padBoth($member->street, 50 - floor(strlen($member->street)/3), '.') }}</span>
                    </div>
                    <div>
                        <span>{{ __('ตำบล ') . Str::padBoth($member->sub_district, 60 - floor(strlen($member->sub_district)/3), '.') }}</span> 
                        <span>{{ __('อำเภอ ') . Str::padBoth($member->district, 60 - floor(strlen($member->district)/3), '.') }}</span>
                        <span>{{ __('จังหวัด ') . Str::padBoth($member->province, 60 - floor(strlen($member->province)/3), '.') }}</span>
                    </div>
                    <div>
                        <span>{{ __('รหัสไปรษณีย์ ') . Str::padBoth($member->post_code, 16 - strlen($member->post_code), '.') }}</span>
                        <span>{{ __('โทรศัพท์ที่บ้าน ') . Str::padBoth($member->tel, 16 - strlen($member->tel), '.') }}</span>
                        <span>{{ __('โทรศัทพ์มือถือ ') . Str::padBoth($member->mobile, 16 - strlen($member->mobile), '.') }}</span>
                        <span>{{ __('Email ') . Str::padBoth($member->mail, 40 - strlen($member->mail), '.') }}</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 10%; vertical-align: top;">
                    <strong>{{ __('อาชีพ'); }}</strong>
                </td>
                <td colspan="2" style="width: 90%">
                    <table style="width: 99%">
                        <tbody>
                            <tr>
                                @foreach (['ข้าราชการประจำ', 'ข้าราชการบำนาญ', 'ข้าราชการบำเหน็จ'] as $career)
                                <td>
                                    <input type="checkbox" {{ $career == $member->career? 'checked' :'' }}/>
                                    <label> {{ $career }}</label>
                                </td>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach (['พนักงานรัฐวิสาหกิจ', 'นักเรียน/นักศึกษา', 'เกษตรกร'] as $career)
                                <td>
                                    <input type="checkbox" {{ $career == $member->career? 'checked' :'' }}/>
                                    <label> {{ $career }}</label>
                                </td>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach (['ลูกจ้างประจำ', 'ค้าขาย', 'พนักงานเอกชน'] as $career)
                                <td>
                                    <input type="checkbox" {{ $career == $member->career? 'checked' :'' }}/>
                                    <label> {{ $career }}</label>
                                </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" {{ $member->career == 'อื่นๆ'? 'checked' :'' }}/>
                                    <label> {{ __('อื่นๆ ') . $member->other_career }}</label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">{{ __('รายได้ ') . Str::padBoth(number_format($member->income_amount, 2), 30, '.') . __('บาท')}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width: 10%; vertical-align: top;">
                    <strong>{{ __('การศึกษา'); }}</strong>
                </td>
                <td colspan="2" style="width: 90%">
                    @foreach (['ต่ำกว่ามัธยมศึกษาตอนปลาย', 'มัธยมศึกษาตอนปลาย', 'อนุปริญญา', 'ปวช./ปวส.', 'ปริญญาตรี', 'ปริญญาโท', 'ปริญญาเอก', 'อื่นๆ'] as $edu)
                    <div>
                        <input type="checkbox" {{ $edu == $member->education_level? 'checked' :'' }}/>
                        <label> {{ $edu == 'อื่นๆ'? 'อื่นๆ ' . Str::padBoth($member->other_education_level, 40 - floor(strlen($member->other_education_level)/3), '.'): $edu }}</label>
                    </div>
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>
    <div style="page-break-after: always;"></div>
    <table style="width: 100%; margin: 0;">
        <tbody>
            <tr>
                <td colspan="3" style="text-align: center;"><strong>รายละเอียดหนี้สินแต่ละประเภทของผู้ยื่น</strong></td>
            </tr>
            @foreach (['หนี้สินในระบบแบบถูกกฏหมาย', 'หนี้สินนอกระบบแบบถูกกฏหมาย', 'หนี้สินนอกระบบแบบผิดกฏหมาย', 'หนี้สินแบบสหกรณ์'] as $debt_type)
            <tr>
                <td style="width: 2%"><strong>{{ $loop->iteration }}</strong></td>
                <td colspan="2"><strong>{{ $debt_type }}</strong></td>
            </tr>
            @foreach ($debts[$loop->iteration] as $debt)
            <tr>
                <td style="width: 2%"></td>
                <td style="width: 4%; vertical-align: top;">{{ $loop->parent->iteration . '.' . $loop->iteration }}</td>
                <td style="width: 95%">
                    {{-- ($debt['type'] != 4? 'สถาบันการเงิน': 'สหกรณ์') --}}
                    <div>@if ($debt['type'] == 1 || $debt['type'] == 2) สถาบันการเงิน @elseif ($debt['type'] == 3) ชื่อ-นามสกุล ผู้ให้กู้ @else สหกรณ์ @endif{{  Str::padBoth($debt['bank_name'], 150 - floor(strlen($debt['bank_name'])/3), '.') }}</div>
                    <div>
                        <span>{{ __('จำนวนเงินที่กู้') . Str::padBoth(number_format($debt['total_amount'], 2), 30, '.') . __(' บาท') }}</span>
                        <span>{{ __('เป็นหนี้คงเหลือ') . Str::padBoth(number_format($debt['remaining_amount'], 2), 70, '.') . __(' บาท') }}</span>
                    </div>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" style="padding: 1rem 0;">
                    <div><strong>{{ __('รวมยอดเงินที่กู้') . Str::padBoth(number_format($sum[$loop->iteration]['total'], 2), 30, '.') . __(' บาท') }}</strong></div>
                    <div><strong>{{ __('รวมยอดเงินหนี้สินคงเหลือ') . Str::padBoth(number_format($sum[$loop->iteration]['remaining'], 2), 30, '.') . __(' บาท') }}</strong></div>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" style="padding: 1rem 0;">
                    <div style="text-align: center;"><strong>{{ __('รวมยอดเงินที่กู้ทั้งหมด') }}</strong></div>
                    <div><strong>{{ __('รวมยอดเงินที่กู้ทั้งหมด') . Str::padBoth(number_format($net_total, 2), 30, '.') . __(' บาท') }}</strong></div>
                    <div><strong>{{ __('รวมยอดเงินหนี้สินคงเหลือทั้งหมด') . Str::padBoth(number_format($net_remaining, 2), 30, '.') . __(' บาท') }}</strong></div>
                </td>
            </tr>
        </tbody>
    </table>
    <div style="page-break-after: always;"></div>
    <div><strong>(รายละเอียดปรากฏตาม ผนวก ก. ท้ายบัญชีแสดงรายการหนี้สินนี้)</strong></div>
    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้าขอรับรองว่าเป็นข้อมูลรายการหนี้สินที่ถูกต้อง เป็นความจริงทุกประการ และข้าพเจ้าได้ให้ความยินยอม<br/>และให้การรับรองต่อคณะกรรมการดำเนินตรวจสอบมูลหนี้ในกรณีดังต่อไปนี้</div>
    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.) ข้าพเจ้ายินยอมให้คณะกรรมการดำเนินการตรวจสอบมูลหนี้และพร้อมอำนวยความสะดวก<br/>แก่คณะกรรมการ/คณะทำงาน ในการให้ข้อมูล พยานเอกสารหลักฐาน ตลอดจนพร้อมที่จะให้คำชี้แจงข้อเท็จจริง<br/>อันเกี่ยวกับการตรวจสอบมูลหนี้ ตามที่คณะกรรมการ/คณะทำงานประสงค์</div>
    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.) ข้าพเจ้าจะไม่กระทำการใดอันเป็นการก่อภาระผูกพัน ไม่ว่าบางส่วนหรือทั้งหมด เพื่อให้เกิดภาระ<br/>ผูกพันอันเป็นมูลหนี้มากขึ้น จนทำให้กองทุนอิสระฯ ได้รับความเสียหาย</div>
    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.) ข้อความในบัญชีแสดงรายการหนี้สิน เป็นจริงทุกประการ หากปรากฏเป็นเท็จ โดยประการที่อาจทำให้<br/>กองทุนอิสระฯ ได้รับความเสียหาย ข้าพเจ้ายินยอมลาออกจากสมาชิกกองทุนอิสระฯ และให้กองทุนอิสระฯ ดำเนินคดี<br/>ตามกฎหมาย หรือดำเนินการตามความเหมาะสม</div>
    <table style="margin-top: 1rem; width: 100%">
        <tbody>
            <tr>
                <td style="width: 35%"></td>
                <td style="width: 65%">
                    <table style="width: 100%">
                        <tbody>
                            <tr>
                                <td>(ลงชื่อ)</td>
                                <td></td>
                                <td>ผู้ยื่น/ผู้ให้ความยินยอม/ผู้ให้คำรับรอง</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>({{ Str::padBoth('', 50, '.') }})</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="height: 5rem;"></td>
                            </tr>
                            <tr>
                                <td>(ลงชื่อ)</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>({{ Str::padBoth('', 50, '.') }})</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3">{{ Str::padRight('ประธาน จังหวัด', 80, '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <div style="page-break-after: always;"></div>
    <strong>ผนวก ก. รายละเอียดหนี้สินแต่ละประเภทของผู้ยื่น เอกสาร, หลักฐานประกอบมูลหนี้ผู้ยื่น</strong>
    <table style="width: 100%; margin: 0;">
        <tbody>
            @foreach (['หนี้สินในระบบแบบถูกกฏหมาย', 'หนี้สินนอกระบบแบบถูกกฏหมาย', 'หนี้สินนอกระบบแบบผิดกฏหมาย', 'หนี้สินแบบสหกรณ์'] as $debt_type)
            <tr>
                <td colspan="3"><strong>{{ $loop->iteration . __('.รายละเอียด') . $debt_type }}</strong></td>
            </tr>
            @foreach ($debts[$loop->iteration] as $debt)
            @if ($debt['type'] != 3)
            <tr>
                <td colspan="3">
                    <div>
                        <span>{{ $loop->parent->iteration . '.' . $loop->iteration }}</span>
                        <span>{{ ($debt['type'] != 4? 'สถาบันการเงิน': 'สหกรณ์') . Str::padBoth($debt['bank_name'], 60 - floor(strlen($debt['bank_name'])/3), '.') }}</span>
                        <span>{{ __('สาขา') . Str::padBoth($debt['bank_branch'], 60 - floor(strlen($debt['bank_branch'])/3), '.') }}</span>
                        <span>{{ __('เบอร์โทรศัพท์') . Str::padBoth($debt['contact'], 20 - strlen($debt['contact']), '.') }}</span>
                    </div>
                    <div>
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ __('เลขที่สัญญา') . Str::padBoth($debt['contract_no'], 50 - strlen($debt['contract_no']), '.') }}</span>
                        <span>{{ __('ลงวันที่ลงสัญญา') . Str::padBoth($debt['contract_date'], 30 - strlen($debt['contract_date']), '.') }}</span>
                        <span>{{ __('ยอดหนี้คงเหลือ') . Str::padBoth(number_format($debt['remaining_amount'], 2), 30, '.') . __(' บาท') }}</span>
                    </div>
                </td>
            </tr>
            @else
            <tr>
                <td colspan="3">
                    <div>
                        <span>{{ $loop->parent->iteration . '.' . $loop->iteration }}</span>
                        <span>{{ __('กู้ยืมเงินจาก') . Str::padBoth($debt['bank_name'], 100 - floor(strlen($debt['bank_name'])/3), '.') }}</span>
                        <span>{{ __('เบอร์โทรศัพท์') . Str::padBoth($debt['contact'], 40 - strlen($debt['contact']), '.') }}</span>
                    </div>
                    <div>
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ __('จำนวนเงินที่กู้ยืม') . Str::padBoth(number_format($debt['total_amount'], 2), 30, '.') . __(' บาท') }}</span>
                        <span>{{ __('ดอกเบี้ยร้อยละ') . Str::padBoth($debt['interest'], 10, '.') }}</span>
                        <span>{{ __('ยอดหนี้คงเหลือ') . Str::padBoth(number_format($debt['remaining_amount'], 2), 30, '.') . __(' บาท') }}</span>
                    </div>
                    <div>
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ __('ตามหนังสือรับรองหนี้/กู้ยืมเงิน ลงวันที่') . Str::padBoth($debt['contract_date'], 30 - strlen($debt['contract_date']), '.') }}</span>
                    </div>
                </td>
            </tr>
            @endif
            <tr>
                <td colspan="3">สถานะหนี้</td>
            </tr>
            <tr>
                <td style="width: 30%">
                    <input type="checkbox" {{ $debt['status'] == 'ปกติ'? 'checked' :'' }}/>
                    <label>ปกติ</label>
                </td>
                <td style="width: 30%">
                    <input type="checkbox" {{ $debt['status'] == 'ขายทอดตลาด'? 'checked' :'' }}/>
                    <label>ขายทอดตลาด</label>
                </td>
                <td rowspan="4" style="width: 40%; vertical-align: top;">
                    <div>{{ __('วันที่ถูกฟ้องต่อศาล') . Str::padBoth($debt['date_1'], 40 - strlen($debt['date_1']), '.') }}</div>
                    <div>{{ __('วันที่ถูกฟ้องต่อศาล') . Str::padBoth($debt['date_2'], 40 - strlen($debt['date_2']), '.') }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" {{ $debt['status'] == 'ได้รับหมายศาล'? 'checked' :'' }}/>
                    <label>ได้รับหมายศาล</label>
                </td>
                <td>
                    <input type="checkbox" {{ $debt['status'] == 'ล้มละลาย'? 'checked' :'' }}/>
                    <label>ล้มละลาย</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" {{ $debt['status'] == 'ไกล่เกลี่ย'? 'checked' :'' }}/>
                    <label>ไกล่เกลี่ย</label>
                </td>
                <td>
                    <input type="checkbox" {{ $debt['status'] == 'อื่นๆ'? 'checked' :'' }}/>
                    <label>อื่นๆ {{ $debt['other_status']}}</label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="checkbox" {{ $debt['status'] == 'บังคับคดี'? 'checked' :'' }}/>
                    <label>บังคับคดี</label>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" style="padding: 2rem 0;">
                    <div style="font-weight: bold; text-align: center;">{{ __('รวม') . $debt_type }}</div>
                    <div><strong>{{ __('รวมยอดเงินที่กู้') . Str::padBoth(number_format($sum[$loop->iteration]['total'], 2), 30, '.') . __(' บาท') }}</strong></div>
                    <div><strong>{{ __('รวมยอดเงินหนี้สินคงเหลือ') . Str::padBoth(number_format($sum[$loop->iteration]['remaining'], 2), 30, '.') . __(' บาท') }}</strong></div>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" style="padding: 2rem 0;">
                    <div><strong>{{ __('หมายเหตุ : เอกสารประกอบการแสดงรายการหนี้สิน') }}</strong></div>
                    <div><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('1. สำเนาบัตรประจำตัวของผู้ยื่น') }}</strong></div>
                    <div><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('2. สำเนาทะเบียนบ้านของผู้ยื่น') }}</strong></div>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>