<!DOCTYPE html>
<html lang="en">
<header>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบสมัครสมาชิก/สัญญา</title>
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
        html { margin: 1cm 1.5cm 1.5cm; }
        body { font-family: 'Sarabun', sans-serif; font-size: 16pt; line-height: normal;  }
        table { width: 100%; margin: 0; }
        th, td { padding: 0; }
        table#tbl-sign { margin: 50px 0; }
        table#tbl-sign , 
        table#tbl-sign th, 
        table#tbl-sign td { border: 1px solid black; border-collapse: collapse; padding: 0 1rem; }
        /* span { border: 1px solid black; } */
        input[type=radio] { margin-top: .3rem; margin-left: 1rem; }
    </style>
</header>
<body>
    <table>
        <tbody>
            <tr>
                <td><img style="height: 140px;" src="{{ public_path('mujarin-nakaraj.png') }}"/></td>
                <td style="text-align: center; font-weight: bold;">ใบสมัครสมาชิก/สัญญา (สมัครออนไลน์)<br/>กองทุนอิสระสวัสดิการสงเคราะห์สัจจะออมทรัพย์เพื่อสวัสดิการสังคม<br/>เข้าร่วม<br/>โครงการช่วยเหลือการแก้ไขปัญหาหนี้สินแบบปลอดดอกเบี้ย<br/>ภายใต้ มูลนิธิ "มุจลินท์นาคราช"</td>
                <td><img style="height: 140px;" src="{{ public_path('logo.png') }}"/></td>
            </tr>
            <tr>
                <td colspan="2"><strong>{{ __('วันที่รับเรื่อง') }}</strong> {{ $created }}</td>
                <td>
                    <div style="border: 1px solid; width: 125px; height: 162px;"></div>
                </td>
            </tr>
        </tbody>
    </table>
    <strong>1.ข้อมูลส่วนตัว</strong>
    <br/>
    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('ข้าพเจ้าชื่อ') . Str::padBoth($member_name, $member_name_len, '.') . __('นามสกุล') .Str::padBoth($member->lastname, $member_lastname_len, '.')}}</span>
    <br/>
    <span>{{__('บัตรประจำตัวประชาชนเลขที่').Str::padBoth($member->id_card_no, 60, '.').__('บัตรข้าราชการ/บัตรพนักงานรัฐวิสาหกิจ')}}</span>
    <br/>
    <span>{{__('เลขที่').Str::padBoth($member->emp_card_no, 30, '.').__('วันหมดอายุ').Str::padBoth($exp_date_th, 40, '.').__('อายุ').Str::padBoth($member->age, 10, '.').__('ปี สัญชาติ').Str::padBoth($member->nationality, 18, '.').__('โทรศัพท์').Str::padBoth($member->tel, 16, '.')}}</span>
    <br/>
    <table>
        <tr>
            <td width="20%">{{__('เป็นบุคคลล้มละลายหรือไม่ ')}}</td>
            <td width="30%">
                <input type="radio" @if($member->is_bankrupt == 'เป็น') checked @endif/>
                <label>{{__(' เป็น')}}</label>
                <input type="radio" @if($member->is_bankrupt == 'ไม่เป็น') checked @endif/>
                <label>{{__(' ไม่เป็น')}}</label>
            </td>
            <td width="25%">{{__('คนไร้ความสามารถ ')}}</td>
            <td width="25%">
                <input type="radio" @if($member->is_incompetent_person == 'ใช่') checked @endif/>
                <label>{{__(' ใช่')}}</label>
                <input type="radio" @if($member->is_incompetent_person == 'ไม่ใช่') checked @endif/>
                <label>{{__(' ไม่ใช่')}}</label>
            </td>
        </tr>
        <tr>
            <td>{{__('ทุพพลภาพถาวร ')}}</td>
            <td>
                <input type="radio" @if($member->is_permanent_disability == 'ใช่') checked @endif/>
                <label>{{__(' ใช่')}}</label>
                <input type="radio" @if($member->is_permanent_disability == 'ไม่ใช่') checked @endif/>
                <label>{{__(' ไม่ใช่')}}</label>
            </td>
            <td>{{__('คนเสมือนไร้ความสามารถ ')}}</td>
            <td>
                <input type="radio" @if($member->is_quasi_incompetent_person == 'ใช่') checked @endif/>
                <label>{{__(' ใช่')}}</label>
                <input type="radio" @if($member->is_quasi_incompetent_person == 'ไม่ใช่') checked @endif/>
                <label>{{__(' ไม่ใช่')}}</label>
            </td>
        </tr>
        <tr>
            <td>{{__('สถานภาพสมรส ')}}</td>
            <td colspan="3">
                <input type="radio" @if($member->marital_status == 'โสด') checked @endif/>
                <label>{{__(' โสด')}}</label>
                <input type="radio" @if($member->marital_status == 'หย่า') checked @endif/>
                <label>{{__(' หย่า')}}</label>
                <input type="radio" @if($member->marital_status == 'สมรสจดทะเบียน') checked @endif/>
                <label>{{__(' สมรสจดทะเบียน')}}</label>
                <input type="radio" @if($member->marital_status == 'สมรสไม่จดทะเบียน') checked @endif/>
                <label>{{__(' สมรสไม่จดทะเบียน')}}</label>
                <input type="radio" @if($member->marital_status == 'หม้าย') checked @endif/>
                <label>{{__(' หม้าย')}}</label>
            </td>
        </tr>
    </table>
    <span>{{__('จำนวนบุตร ').Str::padBoth($member->number_of_children, 20, '.').__('คน กำลังศึกษาอยู่ ').Str::padBoth($member->number_of_children_study, 20, '.').__('คน')}}</span>
    <br/>
    <span>{{__('ชื่อ-นามสกุล คู่สมรสม ').Str::padBoth($spouse['name'], $spouse['name_len'], '.').__('นามสกุล').Str::padBoth($member->spouse_lastname, $spouse['lastname_len'], '.')}}</span>
    <br/>
    <span>{{__('บัตรประจำตัวประชาชนเลขที่').Str::padBoth($member->spouse_id_card_no, 30, '.').__('ที่อยู่ตามทะเบียนบ้านเลขที่').Str::padBoth($member->house_no, 20, '.').__('หมู่ที่').Str::padBoth($member->moo, 20, '.')}}</span>
    <br/>
    <span>{{__('ตรอก/ซอย').Str::padBoth($member->soi, 50, '.').__('ถนน').Str::padBoth($member->street, 50, '.').__('ตำบล/แขวง').Str::padBoth($member->sub_district, 55, '.')}}</span>
    <br/>
    <span>{{__('อำเภอ').Str::padBoth($member->district, 60, '.').__('จังหวัด').Str::padBoth($member->province, 60, '.').__('รหัสไปรษณีย์').Str::padBoth($member->post_code, 10, '.').__('โทรศัพท์').Str::padBoth($member->tel, 20, '.')}}</span>
    <br/>
    <span>{{__('โทรสาร').Str::padBoth($member->fax, 20, '.').__('อีเมล').Str::padBoth($member->mail, 60, '.')}}</span>
    <br/>
    <strong><u>{{__('ที่อยู่จัดส่งเอกสาร')}}</u></strong>
    <br/>
    <span>{{__('บ้านเลขที่').Str::padBoth($member->ship_house_no, 12, '.').__('หมู่ที่').Str::padBoth($member->ship_house_no, 12, '.').__('ตรอก/ซอย').Str::padBoth($member->ship_soi, 24, '.').__('ถนน').Str::padBoth($member->ship_street, 36, '.').__('ตำบล/แขวง').Str::padBoth($member->ship_sub_district, 48, '.')}}</span>
    <br/>
    <span>{{__('อำเภอ').Str::padBoth($member->ship_district, 48, '.').__('จังหวัด').Str::padBoth($member->ship_province, 48, '.').__('รหัสไปรษณีย์').Str::padBoth($member->ship_postcode, 24, '.').__('โทรศัพท์').Str::padBoth($member->ship_tel, 24, '.')}}</span>
    <br/>
    <span>{{__('Email').Str::padBoth($member->ship_mail, 50, '.').__('ID Line').Str::padBoth($member->ship_line, 50, '.').__('Facebook').Str::padBoth($member->ship_fb, 50, '.')}}</span>
    <br/>
    <strong><u>{{__('ที่อยู่อาศัยปัจจุบัน')}}</u></strong>
    <br/>
    <span>
        <input type="radio" @if($member->house_type == 'บ้านตนเองปลอดภาระ') checked @endif/>
        <label>{{__(' บ้านตนเองปลอดภาระ')}}</label>
        <input type="radio" @if($member->house_type == 'บ้านของมิดามารดา') checked @endif/>
        <label>{{__(' บ้านของมิดามารดา')}}</label>
        <input type="radio" @if($member->house_type == 'บ้านของญาติ') checked @endif/>
        <label>{{__(' บ้านของญาติ')}}</label>
        <input type="radio" @if($member->house_type == 'บ้านพักสวัสดิการ') checked @endif/>
        <label>{{__(' บ้านพักสวัสดิการ')}}</label>
    </span>
    <br/>
    <span>
        <input type="radio" @if($member->house_type == 'บ้านตนเองและผ่อนอยู่กับสถาบันการเงิน') checked @endif/>
        <label>
            {{__(' บ้านตนเองและผ่อนอยู่กับสถาบันการเงิน ผ่อนชำระ') }}
            @if ($member->house_type == 'บ้านตนเองและผ่อนอยู่กับสถาบันการเงิน')
            {{Str::padBoth(number_format($member->cost_per_month), 20, '.')}}
            @else
            {{Str::padBoth(null, 20, '.')}}
            @endif
            {{__('บาท/เดือน อาศัยอยู่เป็นเวลา').Str::padBoth($member->house_year, 10, '.').__('ปี')}}
        </label>
    </span>
    <br/>
    <span>
        <input type="radio" @if($member->house_type == 'บ้านเช่า') checked @endif/>
        <label>
            {{__(' บ้านเช่า ค่าเช่า') }}
            @if ($member->house_type == 'บ้านเช่า')
            {{Str::padBoth(number_format($member->cost_per_month), 20, '.')}}
            @else
            {{Str::padBoth(null, 20, '.')}}
            @endif
            {{__('บาท/เดือน')}}
        </label>
    </span>
    <br/>
    <strong>ระดับการศึกษาสูงสุด</strong>
    <br/>
    <input type="radio" @if($member->education_level == 'ต่ำกว่ามัธยมศึกษาตอนปลาย') checked @endif/>
    <label>{{__(' ต่ำกว่ามัธยมศึกษาตอนปลาย')}}</label>
    <input type="radio" @if($member->education_level == 'มัธยมศึกษาตอนปลาย') checked @endif/>
    <label>{{__(' มัธยมศึกษาตอนปลาย')}}</label>
    <input type="radio" @if($member->education_level == 'อนุปริญญา') checked @endif/>
    <label>{{__(' อนุปริญญา')}}</label>
    <input type="radio" @if($member->education_level == 'ปวช./ปวส.') checked @endif/>
    <label>{{__(' ปวช./ปวส.')}}</label>
    <br/>
    <input type="radio" @if($member->education_level == 'ปริญญาตรี') checked @endif/>
    <label>{{__(' ปริญญาตรี')}}</label>
    <input type="radio" @if($member->education_level == 'ปริญญาโท') checked @endif/>
    <label>{{__(' ปริญญาโท')}}</label>
    <input type="radio" @if($member->education_level == 'ปริญญาเอก') checked @endif/>
    <label>{{__(' ปริญญาเอก')}}</label>
    <input type="radio" @if($member->education_level == 'อื่นๆ') checked @endif/>
    <label>{{__(' อื่นๆ').Str::padBoth($member->other_education_level, 40, '.')}}</label>
    <br/>
    <strong>สาขาอาชีพ</strong>
    <br/>
    <table>
        <tr>
            <td width="25%">
                <input type="radio" @if($member->career == 'ข้าราชการประจำ') checked @endif/>
                <label>{{__(' ข้าราชการประจำ')}}</label>
            </td>
            <td width="25%">
                <input type="radio" @if($member->career == 'ข้าราชการบำนาญ') checked @endif/>
                <label>{{__(' ข้าราชการบำนาญ')}}</label>
            </td>
            <td width="25%">
                <input type="radio" @if($member->career == 'ข้าราชการบำเหน็จ') checked @endif/>
                <label>{{__(' ข้าราชการบำเหน็จ')}}</label>
            </td>
            <td width="25%">
                <input type="radio" @if($member->career == 'พนักงานรัฐวิสาหกิจ') checked @endif/>
                <label>{{__(' พนักงานรัฐวิสาหกิจ')}}</label>
            </td>
        </tr>
        <tr>
            <td width="25%">
                <input type="radio" @if($member->career == 'นักเรียน/นักศึกษา') checked @endif/>
                <label>{{__(' นักเรียน/นักศึกษา')}}</label>
            </td>
            <td width="25%">
                <input type="radio" @if($member->career == 'เกษตรกร') checked @endif/>
                <label>{{__(' เกษตรกร')}}</label>
            </td>
            <td width="25%">
                <input type="radio" @if($member->career == 'ลูกจ้างประจำ') checked @endif/>
                <label>{{__(' ลูกจ้างประจำ')}}</label>
            </td>
            <td width="25%">
                <input type="radio" @if($member->career == 'ค้าขาย') checked @endif/>
                <label>{{__(' ค้าขาย')}}</label>
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" @if($member->career == 'พนักงานเอกชน') checked @endif/>
                <label>{{__(' พนักงานเอกชน')}}</label>
            </td>
            <td colspan="3">
                <input type="radio" @if($member->career == 'อื่นๆ') checked @endif/>
                <label>{{__(' อื่นๆ').Str::padBoth($member->other_career, 40, '.')}}</label>
            </td>
        </tr>
    </table>
    <strong>2.รายได้ประจำ</strong>
    <br/>
    <input type="radio" @if($member->income_type == 'เงินเดือน/เงินบำนาญ/เงินรายได้') checked @endif/>
    <label>
        {{__(' เงินเดือน/เงินบำนาญ/เงินรายได้')}}
        @if ($member->income_type == 'เงินเดือน/เงินบำนาญ/เงินรายได้') 
        {{Str::padBoth(number_format($member->income_amount), 40, '.')}}
        @else
        {{Str::padBoth('', 40, '.')}}
        @endif
        {{__('บาท/เดือน')}}
    </label>
    <br/>
    <input type="radio" @if($member->income_type == 'เงินค่าจ้าง/เงินค่าตอบแทน') checked @endif/>
    <label>
        {{__(' เงินค่าจ้าง/เงินค่าตอบแทน')}}
        @if ($member->income_type == 'เงินค่าจ้าง/เงินค่าตอบแทน') 
        {{Str::padBoth(number_format($member->income_amount), 40, '.')}}
        @else
        {{Str::padBoth('', 40, '.')}}
        @endif
        {{__('บาท/เดือน')}}
    </label>
    <br/>
    <strong>รายได้อื่นๆ (พร้อมเอกสารประกอบ เช่น ภงด.50 ทวิ เป็นต้น)</strong>
    <br/>
    <input type="radio" @if($member->other_income_type == 'ค่าล่วงเวลา') checked @endif/>
    <label>
        {{__(' ค่าล่วงเวลา เฉลี่ยต่อเดือน จำนวน')}}
        @if ($member->other_income_type == 'ค่าล่วงเวลา') 
        {{Str::padBoth(number_format($member->other_income_amount), 40, '.')}}
        @else
        {{Str::padBoth('', 40, '.')}}
        @endif
        {{__('บาท/เดือน')}}
    </label>
    <br/>
    <input type="radio" @if($member->other_income_type == 'ค่าคอมมิชชั่น') checked @endif/>
    <label>
        {{__(' ค่าคอมมิชชั่น เฉลี่ยต่อเดือน จำนวน')}}
        @if ($member->other_income_type == 'ค่าคอมมิชชั่น') 
        {{Str::padBoth(number_format($member->other_income_amount), 40, '.')}}
        @else
        {{Str::padBoth('', 40, '.')}}
        @endif
        {{__('บาท/เดือน')}}
    </label>
    <br/>
    <input type="radio" @if($member->other_income_type == 'อื่นๆ') checked @endif/>
    <label>{{__(' อื่นๆ').__('จำนวน').Str::padBoth($member->other_income_type == 'อื่นๆ'? number_format($member->other_income_amount): '', 40, '.').__('บาท/เดือน แหล่งที่มา ').Str::padBoth($member->source_other_income, 60, '.')}}</label>
    <br/>
    <strong>3.ภาระหนี้กับสถาบันการเงิน</strong>
    <br/>
    <div style="padding-left: 22pt;">{{__('3.1.หนี้สินในระบบแบบถูกกฏหมาย เป็นหนี้คงเหลือ').Str::padBoth($member->debt_type_1? number_format($member->debt_type_1): '', 20, '.').__('บาท')}}<br/>{{__('3.2.หนี้สินนอกระบบแบบถูกกฏหมาย เป็นหนี้คงเหลือ').Str::padBoth($member->debt_type_2? number_format($member->debt_type_2): '', 20, '.').__('บาท')}}<br/>{{__('3.3.หนี้สินนอกระบบแบบผิดกฏหมาย เป็นหนี้คงเหลือ').Str::padBoth($member->debt_type_3? number_format($member->debt_type_3): '', 20, '.').__('บาท')}}<br/>{{__('3.4.หนี้สินแบบสหกรณ์ เป็นหนี้คงเหลือ').Str::padBoth($member->debt_type_4? number_format($member->debt_type_4) : '', 20, '.').__('บาท')}}</div>
    <strong>4.สถานทีทำงาน</strong>
    <br/>
    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('ชื่อสถานที่ทำงาน') . Str::padBoth($member->workplace, 55, '.').__('อาคาร').Str::padBoth($member->building, 45, '.').__('ชั้น') . Str::padBoth($member->floor, 35, '.')}}</span>
    <br/>
    <span>{{ __('แผนก/ฝ่าย').Str::padBoth($member->department, 50, '.').__('เลขที่').Str::padBoth($member->workplace_no, 20, '.').__('หมู่ที่').Str::padBoth($member->workplace_moo, 20, '.').__('ตรอก/ซอย').Str::padBoth($member->workplace_soi, 40, '.')}}</span>
    <br/>
    <span>{{ __('ถนน').Str::padBoth($member->workplace_street, 60, '.').__('ตำบล/แขวง').Str::padBoth($member->workplace_sub_district, 60, '.').__('อำเภอ/เขต').Str::padBoth($member->workplace_district, 60, '.')}}</span>
    <br/>
    <span>{{ __('จังหวัด').Str::padBoth($member->workplace_province, 60, '.').__('รหัสไปรษณีย์').Str::padBoth($member->workplace_postcode, 35, '.').__('โทรศัพท์').Str::padBoth($member->workplace_tel, 35, '.')}}</span>
    <br/>
    <span>{{ __('โทรสาร').Str::padBoth($member->workplace_fax, 35, '.').__('อายุงานปัจจุบัน').Str::padBoth($member->work_exp, 35, '.').__('ปี ชื่อตำแหน่งงาน').Str::padBoth($member->job_position, 60, '.')}}</span>
    <br/>
    <span>{{ __('กรณีที่ผู้มีรายได้ประจำ อายุงานไม่ถึง 6 เดือน โปรดระบุชื่อสถานที่ทำงานเดิม').Str::padBoth($member->old_workplace, 70, '.')}}</span>
    <br/>
    <strong>5.คุณสมบัติของการสมัครเข้าร่วมเป็นสมาชิกกองทุนอิสระฯ</strong> ตามโครงการช่วยเหลือแก้ไขหนี้สินแบบปลอดดอกเบี้ย
    <div style="padding-left: 22pt;">5.1.เป็นบุคคลที่มีอายุตั้งแต่ 20 ปีขึ้นไป ทั้งคนไทยหรือบุคคลต่างด้าวที่ทำงานและมีที่พักอาศัยอยู่ในประเทศไทย<br/>มาเป็นระยะเวลาไม่น้อยกว่า2 ปี<br/>5.2.เป็นผู้มีนิสัยอันดีงาม มีความรู้ ความเข้าใจ เห็นชอบด้วยหลักการ ระเบียบข้อบังคับ และการดำเนินงานบริหาร<br/>ของกองทุนอิสระฯ และสมัครใจเข้ามามีส่วนร่วมในกิจกรรมต่างๆ ของกองทุนอิสระฯ<br/>5.3.เป็นผู้ถึงพร้อมที่จะต้องปฏิบัติตามระเบียบข้อบังคับของกองทุนอิสระฯ อย่างเคร่งครัด<br/>5.4.เป็นผู้ที่คณะกรรมการกองทุนอิสระฯ ได้มีมติเห็นชอบให้เข้าร่วมเป็นสมาชิกกองทุนอิสระฯ<br/>5.5.มีความอดทนรู้จักเสียสละและเห็นแก่ประโยชน์ส่วนรวมและสมาชิกของกองทุนอิสระฯเป็นสำคัญ<br/>5.6.เป็นผู้ที่สามารถมีความตั้งมั่นในการฝากเงินสัจจะออมทรัพย์เพื่ออนาคตตัวเองและครอบครัวตามสัญญา<br/>อย่างเคร่งครัด<br/>5.7.ผู้ที่สมัครเข้าร่วมเป็นสมาชิกกองทุนอิสระฯ ในปีแรกจะต้องไม่เคยเป็นผู้ที่ค้างชำระหนี้ในกองทุนอื่นๆ<br/>หากยังค้างชำระ ให้ตัดสิทธิ์ในการได้รับการพิจารณาอนุมัติจากกองทุนอิสระฯ จนกว่าจะชำระหนี้ที่ค้างอยู่ให้เสร็จสิ้น<span style="color: red">(ยกเว้นกรณีที่เป็นผู้สมัครรายใหม่ ที่มีความจำนงเข้าร่วมในโครงการนี้เท่านั้น)</span> ทั้งนี้ผู้สมัครที่ถูกตัดสิทธิ์เมื่อความปรากฏ<br/>ในภายหลังว่า ปกปิดว่าเป็นหนี้กองทุนอื่นอยู่ ผู้สมัครจะไม่ได้รับค่าสมัครแรกเข้า และค่าธรรมเนียมรายปีคืนแต่อย่างใด<br/>เว้นแต่กองทุนอิสระฯ อนุญาตเป็นการเฉพาะราย โดยให้ขึ้นอยู่กับดุลพินิจของประธานกองทุนอิสระฯ</div>
    <strong>6.การสมัครขอเข้าร่วมเป็นสมาชิกกองทุนอิสระฯ</strong> โครงการช่วยเหลือแก้ไขหนี้สินแบบปลอดดอกเบี้ย ด้วยความสมัครใจ
    <div style="padding-left: 22pt;">6.1.ยื่นใบสมัครเป็นสมาชิกกองทุนอิสระฯ สามารถยื่นความจำนงได้ที่คณะกรรมการกองทุนอิสระฯ หรือตัวแทน<br/>ของคณะกรรมการกองทุนอิสระฯ ระดับจังหวัด /อำเภอ ที่กองทุนอิสระฯ แต่งตั้งขึ้นและมอบหมายให้ปฏิบัติหน้าที่<br/>6.2.ผู้มีคุณสมบัติตามข้อ 5 สามารถยื่นความจำนง หรือสมัครเข้าเป็นสมาชิกของกองทุนอิสระฯ ได้ (เดือนละ 1 ครั้ง<br/>หรือปีละ 1 ครั้ง) โดยสามารถสมัครเข้าร่วมเป็นสมาชิกกองทุนอิสระฯ ได้โดยปัจเจกบุคคล และกลุ่มองค์กรชุมชน <br/>แล้วแต่ต้องเป็นไปด้วยความสมัครใจของผู้ที่ต้องการเป็นสมาชิกกองทุนอิสระฯ เท่านั้น ทั้งนี้โดยไม่มีการบังคับขู่เข็นใดๆ<br/> และผู้สมัครยินดียกเงินค่าสมัครแรกเข้า ค่าธรรมเนียมบำรุงรายปีตลอดจนค่าใช้จ่ายอื่นๆ ที่เกี่ยวข้องให้กับ<br/>กองทุนอิสระฯเพื่อช่วยเหลือเพื่อนสมาชิกกองทุนอิสระฯ รายอื่นต่อไปโดยตกลงที่จะไม่ขอรับเงินคืนในทุกกรณี <br/>ยกเว้นว่ากองทุนอิสระฯ จะเป็นผู้ผิดสัญญาก็ให้ผู้สมัครเรียกร้องเงินค่าสมัครแรกเข้าและค่าธรรมเนียมอื่นๆที่สมาชิกของ<br/>กองทุนอิสระฯ ได้จ่ายให้กับกองทุนอิสระฯ ตามกำหนดระยะเวลาที่กองทุนอิสระฯ กำหนดแต่จะต้องไม่เกิน 3 เดือน<br/>6.3.คณะกรรมการกองทุนอิสระฯ จะเป็นผู้พิจารณาว่าจะรับบุคคลหนึ่งบุคคลใด เข้าเป็นสมาชิกกองทุนอิสระฯหรือไม่ โดยความชอบธรรม</div>
    <strong>7.เมื่อคณะกรรมการกองทุนอิสระฯ</strong> ได้ดำเนินการประชุมพิจารณาคุณสมบัติของการสมัครเข้าร่วมเป็นสมาชิกกองทุนอิสระฯ<br/>ตาม ข้อ 5  และเห็นสมควรรับบุคคลใดเข้าเป็นสมาชิกกองทุนอิสระฯ จะแจ้งบุคคลที่เป็นสมาชิกกองทุนอิสระฯ นั้นให้ชำระ<br/>ค่าธรรมเนียมแรกเข้า ค่าบำรุงสมาชิกกองทุนอิสระฯ รายปี และเงินฝากสัจจะออมทรัพย์กองทุนอิสระฯ เดือนแรก ส่วนเงิน<br/>ฝากสัจจะออมทรัพย์เดือนถัดไปนั้น สมาชิกกองทุนอิสระฯ จะต้องชำระหนี้ตามเงื่อนไขข้อตกลงที่ได้รับการแก้ไขหนี้สิน<br/>เรียบร้อยแล้ว โดยต้องคืนให้กับกองทุนอิสระฯ ตามสัญญา หลังจากที่กองทุนอิสระฯ ดำเนินการซื้อหนี้สินของสมาชิกกองทุน<br/>อิสระฯ เสร็จสิ้น ทุกเดือนตามจำนวน ข้อ 11.3. เป็นระยะเวลา 120 เดือน หรือ ระยะเวลา 10 ปี หากสมาชิกกองทุนอิสระฯ<br/>ไม่ปฏิบัติตามเงื่อนสัญญา จะต้องชำระหนี้คืนกองทุนอิสระฯ เต็มจำนวนในครั้งแรกที่ได้เคยระบุไว้ในมูลหนี้ก่อนที่จะได้รับ<br/>การช่วยเหลือแก้ไขหนี้แบบปลอดดอกเบี้ย ในครั้งแรกตามที่เอกสารหลักฐานระบุไว้ พร้อมดอกเบี้ยร้อยละ 7.5 ต่อปี<br/>ของต้นเงินดังกล่าว นับตั้งแต่วันที่กองทุนซื้อหนี้ไป เว้นแต่ประธานกองทุนอิสระฯ จะไม่คิดดอกเบี้ยทั้งนี้ให้เป็นดุลยพินิจ<br/>ของประธานกองทุนอิสระฯ เป็นรายๆไป<br/>
    <strong>8.สมาชิกกองทุนอิสระฯ</strong> ขาดหรือพ้นสภาพจากการเป็นสมาชิกกองทุนอิสระฯ ตามเหตุต่างๆ ดังนี้
    <div style="padding-left: 22pt;">8.1.ตาย<br/>8.2.ลาออก และได้รับอนุมัติให้ลาออกจากคณะกรรมการกองทุนอิสระฯ<br/>8.3.วิกลจริต จิตฟั่นเฟือน หรือถูกศาลสั่งให้เป็นผู้ไร้ความสามารถ<br/>8.4.ที่ประชุมใหญ่กองทุนอิสระฯมีมติให้ออกด้วยคะแนนเสียงสองในสามของผู้เข้าร่วมประชุม<br/>8.5.จงใจฝ่าฝืนระเบียบของกองทุนอิสระฯ หรือแสดงตนเป็นปรปักษ์ หรือไม่ให้ความช่วยเหลือ หรือร่วมมือกับกองทุนอิสระฯ ไม่ว่าด้วยประการใด<br/>8.6.มีเจตนาจงใจปิดบังความจริงอันควรแจ้งให้กองทุนอิสระฯ ทราบในใบสมัครสมาชิกกองทุนอิสระฯ<br/>8.7.มีเจตนาหรือจงใจ นำทรัพย์สินของกองทุนอิสระฯ ที่ได้รับไปใช้ผิดวัตถุประสงค์ที่ระบุไว้<br/>8.8 มีลักษณะหรือคุณสมบัติไม่ตรงกับข้อ 5</div>
    <strong>9.สมาชิกกองทุนอิสระฯ</strong>ที่ไม่มีหนี้สินหรือพันธะผูกพันใดๆ กับกองทุนอิสระฯทั้งในฐานะผู้กู้ยืมหรือผู้ค้ำประกัน<br/> เมื่อครบกำหนดตามสัญญาตามที่กองทุนอิสระฯ ได้ดำเนินการซื้อหนี้เรียบร้อยแล้ว หรือสมาชิกกองทุนอิสระฯ<br/>ที่สมัครเข้าเป็นสมาชิกรายใหม่ ไม่ประสงค์เข้าร่วมกับกองทุนอิสระฯ สามารถยื่นความจำนงขอลาออกจากการเป็น<br/>สมาชิกของกองทุนอิสระฯ ได้ หลังจากที่สมัครเข้าร่วมเป็นสมาชิกกองทุนอิสระฯ ครบ 6 เดือนเป็นต้นไปได้โดยแสดง<br/>ความจำนงเป็นหนังสือยื่นต่อคณะกรรมการกองทุนอิสระฯ เพื่อพิจารณาอนุญาต และให้ขาดจากการเป็นสมาชิกภาพกองทุน<br/>อิสระฯ ภายใน 3 วัน นับตั้งแต่ในวันที่คณะกรรมการกองทุนอิสระฯ มีคำสั่งอนุญาต ทั้งนี้เพื่อดำเนินการตรวจสอบ<br/>ความถูกต้อง และคืนเงินฝากสัจจะออมทรัพย์เท่านั้น ให้กับสมาชิกกองทุนอิสระฯ รายใหม่ที่ลาออกทุกราย <br/>โดยกองทุนอิสระฯ ขอสงวนสิทธิ์ในการไม่คืนเงิน ค่าธรรมเนียมแรกเข้า จำนวน 500 บาท และเงินค่าธรรมเนียมบำรุงรายปี<br/>จำนวน 2,000 บาท โดยผู้สมัครสมาชิกกองทุนอิสระฯ  ดังกล่าวตกลงและยินยอมที่จะไม่ขอรับเงินจำนวนดังกล่าวคืน<br/>ทั้งนี้เพื่อให้กองทุนอิสระฯ นำเงินจำนวนดังกล่าวไว้เป็นทุนให้กับสมาชิกกองทุนอิสระฯรายต่อๆไปเพื่อให้ได้รับการแก้ไข<br/>หนี้สินด้วยวิธีซื้อหนี้ต่อไป<br/>
    <strong>10.ผู้ที่ขาดจากการเป็นสมาชิกภาพ</strong> อาจยื่นคำขอเป็นสมาชิกกองทุนอิสระฯ ใหม่ได้ แต่ทั้งนี้จะต้องเป็นผู้ขาดจากสมาชิก<br/>กองทุนอิสระฯ ติดต่อกันไม่น้อยกว่า 3 ปี หรือตามที่คณะกรรมการกองทุนอิสระฯ มีมติเห็นชอบ<br/>
    <strong>11.การคิดค่าธรรมเนียมในการสมัครเข้าเป็นสมาชิกกองทุนอิสระฯ</strong> ตามโครงการช่วยเหลือแก้ไขหนี้สินแบบปลอดดอกเบี้ย
    <div style="padding-left: 22pt;">11.1. ค่าธรรมเนียมแรกเข้า จำนวน 500 บาท<br/>11.2.ค่าบำรุงสมาชิกรายปี จำนวน 2,000 บาท<br/>11.3.เงินฝากสัจจะออมทรัพย์ จำนวนดังต่อไปนี้<br/><div style="padding-left: 22pt;">11.3.1.จำนวนมูลหนี้ต่ำกว่า 431,999 บาท ÷ 120 = จำนวนเงินฝากสัจจะออมทรัพย์ต่อเดือน<br/>11.3.2.จำนวนมูลหนี้ 432,000 บาท ขึ้นไป เงินฝากสัจจะออมทรัพย์ 3,600 บาทต่อเดือน</div></div>
    <strong>12.ค่าธรรมเนียมแรกเข้า จำนวน 500 บาท</strong>ตามที่สมาชิกกองทุนอิสระฯ ได้ชำระเงินไว้ในวันที่สมัครเข้าร่วมเป็นสมาชิก<br/> ทั้งที่เป็นปัจเจกบุคคล กลุ่มหรือองค์กรชุมชน นับจากวันที่ยื่นใบสมัครขอเข้าร่วมเป็นสมาชิกกองทุนอิสระฯ นั้น<br/>ซึ่งหากสมาชิกกองทุนอิสระฯ ลาออก ให้ออก หรือไล่ออก จะไม่ได้รับเงินค่าธรรมเนียมแรกเข้าคืนทุกกรณี โดยผู้สมัคร<br/>สมาชิกกองทุนอิสระฯ ตกลงและยินยอม ทั้งนี้เพื่อให้กองทุนอิสระฯนำเงินจำนวนดังกล่าวไปเป็นทุนช่วยเหลือสมาชิกกอง<br/>ทุนอิสระฯ รายอื่นๆ ต่อไปตามโครงการของกองทุนอิสระฯนี้<br/>
    <strong>13.การคิดค่าธรรมเนียมบำรุงสมาชิกกองทุนอิสระฯ รายปีๆ ละ 2,000 บาท</strong>สมาชิกกองทุนอิสระฯ แรกเข้าตามข้อ 5 <br/>ตกลงให้ความยินยอมโดยสมัครใจที่จะชำระค่าธรรมเนียมบำรุงสมาชิกกองทุนอิสระฯ รายปี เพื่อนำมาสบทบ<br/>เป็นทุนหมุนเวียนในการใช้จ่ายในการจัดระบบสิทธิประโยชน์สวัสดิการสงเคราะห์ ให้กับสมาชิกกองทุนอิสระฯ<br/>ทั้งหมดที่มีอยู่   ตลอดจนการดำเนินการบริหารงานกองทุนอิสระฯ ต่างๆ ของกองทุนอิสระฯ ตลอดจนให้ความยินยอม<br/>ให้คณะกรรมการกองทุนอิสระฯ สามารถนำเงินดังกล่าวไปใช้ในโครงการต่างๆให้เป็นไปตามนโยบายของกองทุนอิสระฯ<br/>กำหนด โดยไม่ต้องแจ้งให้สมาชิกกองทุนอิสระฯ ทราบแต่ประการใด เพื่อเป็นประโยชน์แก่สมาชิกกองทุนอิสระฯ ทั้งมวล<br/>
    <strong>14.วิธีการชำระเงินฝากสัจจะออมทรัพย์</strong>ตามสัญญาซื้อหนี้สิน ในโครงการช่วยเหลือแก้ไขหนี้สินแบบปลอดดอกเบี้ย<br/>ที่ได้ทำสัญญาไว้กับกองทุนอิสระฯ ตามระยะเวลาที่กำหนดไว้ในสัญญา โดยต้องชำระเป็นรายเดือน ทุกวันที่ 5 ของเดือน<br/>เป็นระยะเวลา 120 เดือน ซึ่งสมาชิกกองทุนอิสระฯ ต้องชำระเงินฝากสัจจะออมทรัพย์ ไว้กับกองทุนอิสระฯ โดยสามารถ<br/>จ่ายเป็นเงินสดหรือโอนเข้าบัญชีที่กองทุนอิสระฯ ตามที่กำหนดไว้ โดยผู้สมัครใจเข้าเป็นสมาชิกกองทุนอิสระฯ<br/>ทุกคนจะต้องส่งเงินฝากสัจจะออมทรัพย์งวดแรก จำนวนเงินตามข้อ 11.3. โดยถือว่าเงินฝากสัจจะออมทรัพย์เป็นเงินออม<br/>ระยะยาวหรือเงินฝากสัจจะออมทรัพย์ ที่เป็นการชำระหนี้สินเงินกู้ยืมคืนกองทุนอิสระฯ และสมาชิกกองทุนอิสระฯ จะได้รับ<br/>เงินที่ฝากสัจจะออมทรัพย์คืน หรือปิดบัญชีได้ต่อเมื่อครบสัญญาที่ทำไว้กับกองทุนอิสระฯ หรือการพ้นสภาพ<br/>จากการเป็นสมาชิกกองทุน อิสระฯ เท่านั้น<br/>
    <strong>15. กรณีที่ข้าพเจ้าถึงแก่ความตายในระหว่างที่เป็นสมาชิกกองทุนอิสระฯ</strong> ข้าพเจ้าขอแสดงเจตนารมย์ให้กองทุนอิสระฯ<br/> จ่ายเงินฌาปนกิจสงเคราะห์ 50,000 บาท และหรือผลประโยชน์อย่างอื่นที่ข้าพเจ้าพึงได้รับตามสิทธิของการเป็นสมาชิก<br/>กองทุนอิสระฯ ให้แก่ผู้รับโอนผลประโยชน์ของข้าพเจ้า ดังต่อไปนี้<br/>
    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('ชื่อ-นามสกุล') . Str::padBoth($benef['name'], $benef['name_len'], '.') . __('บัตรประจำตัวประชาชนเลขที่') . Str::padBoth($member->benef_id_card_no, 17, '.')}}</span><br/>
    <span>{{ __('มีความสัมพันธ์เป็น') . Str::padBoth($member->benef_relationship, 30, '.') . __('อยู่บ้านเลขที่') . Str::padBoth($member->benef_house_no, 10, '.') . __('หมู่ที่') . Str::padBoth($member->benef_moo, 10, '.') . __('ตรอก/ซอย') . Str::padBoth($member->benef_soi, 10, '.') . __('ถนน') . Str::padBoth($member->benef_street, 40, '.')}}</span><br/>
    <span>{{ __('ตำบล/แขวง') . Str::padBoth($member->benef_sub_district, 40, '.') . __('อำเภอ') . Str::padBoth($member->benef_district, 50, '.') . __('จังหวัด') . Str::padBoth($member->benef_province, 50, '.') . __('รหัสไปรษณีย์') . Str::padBoth($member->benef_postcode, 15, '.')}}</span><br/>
    <span>{{__('โทรศัพท์') . Str::padBoth($member->benef_tel, 30, '.') . __('E-mail') . Str::padBoth($member->benef_fax, 30, '.')}}</span><br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้าได้อ่านข้อความทั้งหมดจนเป็นที่เข้าใจเป็นอย่างดีแล้ว และขอรับรองว่าข้อความทั้งหมดที่ข้าฯ ได้ระบุไว้<br/>ในใบสมัครหรือสัญญาฉบับนี้ เป็นข้อมูลจริงทุกประการ และข้าฯยินยอมให้กองทุนอิสระฯ ตลอดจนตัวแทนกองทุนอิสระฯ <br/>และเจ้าหนี้ที่เข้าร่วมโครงการช่วยเหลือแก้ไขหนี้สินแบบปลอดดอกเบี้ยนี้ดำเนินการตรวจสอบข้อมูล ขอข้อมูล<br/>และเปิดเผยข้อมูล ตลอดจนใช้ข้อมูลเกี่ยวกับภาระหนี้หลักประกัน และหรือการได้รับสินเชื่อของข้าพเจ้าที่มีอยู่กับสถาบัน<br/>การเงินสมาชิกหรือนิติบุคคลอื่น ที่ได้ถูกรวบรวมไว้ที่บริษัทข้อมูลเครดิตแห่งชาติจำกัดหรือบริษัทข้อมูลเครดิตใดๆ<br/> ตามพระราชบัญญัติการประกอบธุรกิจข้อมูลเครดิตที่จะมีขึ้นต่อไปในภายหน้าได้ทั้งสิ้น ทั้งนี้ไม่ว่าจะเป็นภาระหนี้<br/>และ/หรือวงเงินสินเชื่อที่ข้าพเจ้าเคยมีในอดีต และ/หรือที่มีอยู่ในปัจจุบันตลอดจนที่จะมีขึ้นในภายหน้า<br/>โดยไม่ต้องคำนึงว่าข้าพเจ้าจะได้รับอนุมัติให้เข้าร่วมโครงการหรือไม่ก็ตาม โดยข้าฯ จะไม่นำเอกสารหรือบันทึกข้อความใดๆ <br/>ที่เกี่ยวข้องไปฟ้องร้อง เรียกร้อง ค่าเสียหายใดๆ ได้ ทั้งตามประมวลกฎหมายแพ่งและพาณิชย์หรือประมวลกฎหมายอาญา<br/>หรือตามกฎหมายอื่นๆ ทุกกรณี หรือไม่ติดใจเรียกร้อง หรือเอาความใดๆ กับกองทุนอิสระฯ ตลอดจนผู้มีหน้าที่ดำเนินการ<br/>แทนกองทุนอิสระฯ ไม่ทางแพ่ง หรืออาญา หรือกฎหมายอื่นใด<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ทั้งนี้ หากข้าพเจ้าได้รับการแก้ไขหนี้สินตามโครงการนี้ด้วยการซื้อหนี้สินเสร็จสิ้น อันทรัพย์สินใดๆของข้าพเจ้า<br/>ที่ค้ำประกันไว้กับสถาบันการเงิน หรือเจ้าหนี้ของข้าฯไว้ ข้าฯตกลงยินยอมให้กองทุนอิสระฯ นำหลักทรัพย์ดังกล่าว<br/>มาใช้เป็นหลักค้ำประกัน หนี้สินตามสัญญาฉบับนี้ จนกว่าจะชำระหนี้สินให้กับกองทุนอิสระฯ เสร็จสิ้น โดยไม่มีเงื่อนไข<br/>แต่อย่างใด และยินยอมปฏิบัติตามเงื่อนไขทุกประการ<br/>
    <table>
        <tbody>
            <tr>
                <td style="width: 25%;"></td>
                <td style="width: 50%;">{{ __('ลงนาม') . Str::padBoth('..', 58, '.') . __('ผู้สมัคร')}}</td>
                <td style="width: 25%;"></td>
            </tr>
            <tr>
                <td></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('(') . Str::padBoth('..', 56, '.') . __(') ตัวบรรจง')}}</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>&nbsp;&nbsp;&nbsp;{{ __('วันที่ ') . Str::padBoth('..', 56, '.') }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <table id="tbl-sign">
        <tbody>
            <tr>
                <td style="width: 50%;">
                    <span>{{ __('ลงนาม') . Str::padBoth('..', 58, '.') }}</span>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('(') . Str::padBoth('..', 56, '.') . __(')')}}</span>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ Str::padRight('นายทะเบียนจังหวัด', 76, '.') }}</span>
                </td>
                <td style="width: 50%;">
                    <span>{{ __('ลงนาม') . Str::padBoth('..', 58, '.') }}</span>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('(') . Str::padBoth('..', 56, '.') . __(')')}}</span>
                    <span>{{ __('ประธานกองทุนอิสระฯ ประจำจังหวัด') . Str::padBoth('..', 18, '.') }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding-left: 150pt;">
                    <span>{{ __('ลงนาม') . Str::padBoth('..', 58, '.') }}</span>
                    <br/>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('(') . Str::padBoth('..', 56, '.') . __(')')}}</span>
                    <br/>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('นายทะเบียนกองทุนอิสระฯ') }}</span>
                    <br/>
                    <span>&nbsp;&nbsp;&nbsp;{{ __('วันที่ ') . Str::padBoth('..', 56, '.') }}</span>
                </td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width: 30%; padding-left: 50px; vertical-align: top;">
                    <span>{{ Str::padLeft('', 5, '_') . __('อนุมัติ') }}</span>
                    <br/>
                    <span>{{ Str::padLeft('', 5, '_') . __('ไม่อนุมัติ') }}</span>
                </td>
                <td style="width: 70%; text-align: center;">
                    <span>{{ __('ลงนาม') . Str::padBoth('..', 58, '.') }}</span>
                    <br/>
                    <span>{{ __('(นายณัชภณ วงส์วิเศษ)') }}</span>
                    <br/>
                    <span>{{ __('ประธานกองทุนอิสระสวัสดิการสงเคราะห์สัจจะออมทรัพย์เพื่อสวัสดิการสังคม') }}</span>
                    <br/>
                    <span>{{ __('วันที่ ') . Str::padBoth('..', 56, '.') }}</span>
                </td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="vertical-align: top;"><u><strong>หมายเหตุ</strong></u></td>
                <td>ให้ถือใบสมัครและสัญญาฉบับนี้เป็นการให้สัญญาร่วมกัน ระหว่างกองทุนอิสระสวัสดิการสงเคราะห์สัจจะออมทรัพย์เพื่อสวัสดิการสังคม โดยนายณัชภณ วงส์วิเศษ ประธานกองทุนอิสระฯ กับผู้ลงนามสมัครเป็นสมาชิกกองทุนอิสระฯ ท้ายใบสมัครและตามสัญญาฉบับนี้</td>
            </tr>
        </tbody>
    </table>
</body>
</html>