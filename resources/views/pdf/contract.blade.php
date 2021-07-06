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
        html { margin: 15px 30px; }
        body { font-family: 'Sarabun', sans-serif; font-size: 16pt; line-height: normal; }
        table { width: 100%; }
        th, td { padding: 0; }
        table#tbl-sign { margin: 50px 0; }
        table#tbl-sign , 
        table#tbl-sign th, 
        table#tbl-sign td { border: 1px solid black; border-collapse: collapse; padding: 0 1rem; }
    </style>
</header>
<body>
    <table>
        <tbody>
            <tr>
                <td><img style="width: 120px;" src="{{ public_path('mujarin-nakaraj.png') }}"/></td>
                <td style="text-align: center; font-weight: bold;">ใบสมัครสมาชิก/สมาชิก<br/>กองทุนอิสระสวัสดิการสงเคราะห์สัจจะออมทรัพย์เพื่อสวัสดิการสังคม<br/>เข้าร่วม<br/>โครงการช่วยเหลือการแก้ไขปัญหาหนี้สินแบบปลอดดอกเบี้ย<br/>ภายใต้ มูลนิธิ "มุจลินท์นาคราช</td>
                <td><img style="width: 160px;" src="{{ public_path('logo.png') }}"/></td>
            </tr>
            <tr>
                <td colspan="2"><strong>{{ __('วันที่รับเรื่อง') }}</strong> {{ $created }}</td>
                <td>
                    <div style="border: 1px solid; width: 125px; height: 162px;"></div>
                </td>
            </tr>
        </tbody>
    </table>
    <p>
        <strong>1.ข้อมูลส่วนตัว</strong>
        <br/>
        <span>ข้าพเจ้าชื่อ {{ Str::padLeft($member->title, strlen($member->title) + 20, '.') . Str::padRight($member->firstname, strlen($member->firstname) + 20, '.') }}</span>
        <span> นามสกุล{{Str::padBoth($member->lastname, strlen($member->lastname) + 40, '.')}}</span>
        <br/>
        <span>บัตรประจำตัวประชาชนเลขที่{{Str::padBoth($member->id_card_no, strlen($member->id_card_no) + 30, '.')}}</span>
        <br/>
        <span>บัตรข้าราชการ/บัตรพนักงานรัฐวิสาหกิจเลขที่{{Str::padBoth($member->emp_card_no, strlen($member->emp_card_no) + 30, '.')}}</span>
        <br/>
        <span>วันหมดอายุ{{Str::padBoth($member->exp_date, strlen($member->exp_date) + 20, '.')}}</span>
        <span>อายุ{{Str::padBoth($member->age, strlen($member->age) + 10, '.')}}ปี</span>
        <span>สัญชาติ {{Str::padBoth($member->nationality, strlen($member->nationality) + 10, '.')}}</span>
        <span>โทรศัพท์{{Str::padBoth($member->tel, strlen($member->tel) + 20, '.')}}</span>
        <br/>
        <span>เป็นบุคคลล้มละลายหรือไม่{{Str::padBoth($member->is_bankrupt, strlen($member->is_bankrupt) + 20, '.')}}</span>
        <span> คนไร้ความสามารถ{{Str::padBoth($member->is_incompetent_person, strlen($member->is_incompetent_person) + 20, '.')}}</span>
        <span> ทุพพลภาพถาวร{{Str::padBoth($member->is_permanent_disability, strlen($member->is_permanent_disability) + 20, '.')}}</span>
        <br/>
        <span>คนเสมือนไร้ความสามารถ{{Str::padBoth($member->is_quasi_incompetent_person, strlen($member->is_quasi_incompetent_person) + 10, '.')}}</span>
        <span> สถานภาพสมรส{{Str::padBoth($member->marital_status, strlen($member->marital_status) + 10, '.')}}</span>
        <span> จำนวนบุตร{{Str::padBoth($member->number_of_children, strlen($member->number_of_children) + 4, '.')}}คน</span>
        <span> กำลังศึกษาอยู่{{Str::padBoth($member->number_of_children_study, strlen($member->number_of_children_study) + 4, '.')}}คน</span>
        <br/>
        <span>ชื่อ-นามสกุล คู่สมรสม {{ Str::padLeft($member->spouse_title, strlen($member->spouse_title) + 20, '.') . Str::padRight($member->spouse_firstname, strlen($member->spouse_firstname) + 20, '.') }}</span>
        <span>นามสกุล{{Str::padBoth($member->spouse_lastname, strlen($member->spouse_lastname) + 40, '.')}}</span>
        <br/>
        <span>บัตรประจำตัวประชาชนเลขที่{{Str::padBoth($member->spouse_id_card_no, strlen($member->spouse_id_card_no) + 30, '.')}} ที่อยู่ตามทะเบียนบ้านเลขที่{{Str::padBoth($member->house_no, strlen($member->house_no) + 20, '.')}}</span>
        <br/>
        <span>หมู่ที่{{Str::padBoth($member->moo, strlen($member->moo) + 10, '.')}}</span>
        <span>ตรอก/ซอย{{Str::padBoth($member->soi, strlen($member->soi) + 20, '.')}}</span>
        <span>ถนน{{Str::padBoth($member->street, strlen($member->street) + 20, '.')}}</span>
        <span>ตำบล/แขวง{{Str::padBoth($member->sub_district, strlen($member->sub_district) + 20, '.')}}</span>
        <br/>
        <span>อำเภอ{{Str::padBoth($member->district, strlen($member->district) + 20, '.')}}</span>
        <span>จังหวัด{{Str::padBoth($member->province, strlen($member->province) + 20, '.')}}</span>
        <span>รหัสไปรษณีย์{{Str::padBoth($member->post_code, strlen($member->post_code) + 20, '.')}}</span>
        <br/>
        <span>โทรศัพท์{{Str::padBoth($member->tel, strlen($member->tel) + 20, '.')}}</span>
        <span>โทรสาร{{Str::padBoth($member->fax, strlen($member->fax) + 20, '.')}}</span>
        <span>อีเมล{{Str::padBoth($member->mail, strlen($member->mail) + 20, '.')}}</span>
        <br/>
        <strong>ที่อยู่จัดส่งเอกสาร</strong>
        <br/>
        <span>บ้านเลขที่{{Str::padBoth($member->ship_house_no, strlen($member->ship_house_no) + 6, '.')}}</span>
        <span>หมู่ที่{{Str::padBoth($member->ship_moo, strlen($member->ship_moo) + 6, '.')}}</span>
        <span>ตรอก/ซอย{{Str::padBoth($member->ship_soi, strlen($member->ship_soi) + 8, '.')}}</span>
        <span>ถนน{{Str::padBoth($member->ship_street, strlen($member->ship_street) + 8, '.')}}</span>
        <span>ตำบล/แขวง{{Str::padBoth($member->ship_sub_district, strlen($member->ship_sub_district) + 12, '.')}}</span>
        <br/>
        <span>อำเภอ{{Str::padBoth($member->ship_district, strlen($member->ship_district) + 12, '.')}}</span>
        <span>จังหวัด{{Str::padBoth($member->ship_province, strlen($member->ship_province) + 12, '.')}}</span>
        <span>รหัสไปรษณีย์{{Str::padBoth($member->ship_postcode, strlen($member->ship_postcode) + 12, '.')}}</span>
        <span>โทรศัพท์{{Str::padBoth($member->ship_tel, strlen($member->ship_tel) + 12, '.')}}</span>
        <br/>
        <span>Email{{Str::padBoth($member->ship_mail, strlen($member->ship_mail) + 12, '.')}}</span>
        <span>ID Line{{Str::padBoth($member->ship_line, strlen($member->ship_line) + 12, '.')}}</span>
        <span>Facebook{{Str::padBoth($member->ship_fb, strlen($member->ship_fb) + 20, '.')}}</span>
        <br/>
        <strong>ที่อยู่อาศัยปัจจุบัน</strong>
        <span>{{Str::padBoth($member->house_type, strlen($member->house_type) + 8, '.')}}</span>
        @if ($member->house_type == 'บ้านเช่า')
        <span>ค่าเช่า{{Str::padBoth(number_format($member->cost_per_month), strlen($member->cost_per_month) + 9, '.')}}บาท/เดือน</span>
        @elseif ($member->house_type == 'บ้านตนเองและผ่อนอยู่กับสถาบันการเงิน')
        <span>ผ่อนชำระ{{Str::padBoth(number_format($member->cost_per_month), strlen($member->cost_per_month) + 9, '.')}}บาท/เดือน</span>
        <span>อาศัยอยู่เป็นเวลา{{Str::padBoth($member->house_year, strlen($member->house_year) + 8, '.')}}ปี</span>
        @endif
    </p>
    <p>
        <strong>ระดับการศึกษาสูงสุด</strong>
        @if ($member->education_level == 'อื่นๆ')
        <span>{{Str::padBoth($member->other_education_level, strlen($member->other_education_level) + 20, '.')}}</span>
        @else
        <span>{{Str::padBoth($member->education_level, strlen($member->education_level) + 20, '.')}}</span>
        @endif
        <br/>
        <strong>สาขาอาชีพ</strong>
        @if ($member->career == 'อื่นๆ')
        <span>{{Str::padBoth($member->other_career, strlen($member->other_career) + 20, '.')}}</span>
        @else
        <span>{{Str::padBoth($member->career, strlen($member->career) + 20, '.')}}</span>
        @endif
    </p>
    <p>
        <strong>2.รายได้ประจำ</strong>
        <br/>
        <span>{{ $member->income_type . Str::padBoth(number_format($member->income_amount), strlen($member->income_amount) + 19, '.')}}บาท/เดือน</span>
        @if ($member->field_2_5 > 0)
            <strong>รายได้อื่นๆ (พร้อมเอกสารประกอบ เช่น ภงด.50 ทวิ เป็นต้น)</strong>
            @if($member->field_2_3 == 'อื่นๆ')
            <span>{{ Str::padBoth($member->field_2_4, strlen($member->field_2_4) + 18, '.')}}</span>
            <span>{{ $member->field_2_3 . Str::padBoth(number_format($member->field_2_5), strlen($member->field_2_5) + 19, '.')}}บาท/เดือน</span>
            <span>{{ __('แหล่งที่มา') . Str::padBoth($member->field_2_6, strlen($member->field_2_6) + 18, '.')}}</span>
            @else
            <span>{{ $member->field_2_3 . Str::padBoth(number_format($member->field_2_5), strlen($member->field_2_5) + 19, '.')}}บาท/เดือน</span>
            @endif
        @endif
    </p>
    <p>
        <strong>3.ภาระหนี้กับสถาบันการเงิน</strong>
        <br/>
        <span>{{ $member->debt_type }}</span>
    </p>
    <p>
        <strong>4.สถานทีทำงาน</strong>
        <br/>
        <span>{{ __('ชื่อสถานที่ทำงาน') . Str::padBoth($member->workplace, strlen($member->workplace) + 20, '.')}}</span>
        <span>{{ __('อาคาร') . Str::padBoth($member->building, strlen($member->building) + 20, '.')}}</span>
        <span>{{ __('ชั้น') . Str::padBoth($member->floor, strlen($member->floor) + 10, '.')}}</span>
        <span>{{ __('แผนก/ฝ่าย') . Str::padBoth($member->department, strlen($member->department) + 20, '.')}}</span>
        <br/>
        <span>{{ __('เลขที่') . Str::padBoth($member->workplace_no, strlen($member->workplace_no) + 10, '.')}}</span>
        <span>{{ __('หมู่ที่') . Str::padBoth($member->workplace_moo, strlen($member->workplace_moo) + 10, '.')}}</span>
        <span>{{ __('ตรอก/ซอย') . Str::padBoth($member->workplace_soi, strlen($member->workplace_soi) + 10, '.')}}</span>
        <span>{{ __('ถนน') . Str::padBoth($member->workplace_street, strlen($member->workplace_street) + 20, '.')}}</span>
        <span>{{ __('ตำบล/แขวง') . Str::padBoth($member->workplace_sub_district, strlen($member->workplace_sub_district) + 20, '.')}}</span>
        <br/>
        <span>{{ __('อำเภอ/เขต') . Str::padBoth($member->workplace_district, strlen($member->workplace_district) + 20, '.')}}</span>
        <span>{{ __('จังหวัด') . Str::padBoth($member->workplace_province, strlen($member->workplace_province) + 10, '.')}}</span>
        <span>{{ __('รหัสไปรษณีย์') . Str::padBoth($member->workplace_postcode, strlen($member->workplace_postcode) + 10, '.')}}</span>
        <span>{{ __('โทรศัพท์') . Str::padBoth($member->workplace_tel, strlen($member->workplace_tel) + 10, '.')}}</span>
        <br/>
        <span>{{ __('โทรสาร') . Str::padBoth($member->workplace_fax, strlen($member->workplace_fax) + 10, '.')}}</span>
        <span>{{ __('อายุงานปัจจุบัน') . Str::padBoth($member->work_exp, strlen($member->work_exp) + 10, '.')}}</span>
        <span>{{ __('ชื่อตำแหน่งงาน') . Str::padBoth($member->job_position, strlen($member->job_position) + 20, '.')}}</span>
        <br/>
        <span>{{ __('กรณีที่ผู้มีรายได้ประจำ อายุงานไม่ถึง 6 เดือน โปรดระบุชื่อสถานที่ทำงานเดิม') . Str::padBoth($member->old_workplace, strlen($member->old_workplace) + 20, '.')}}</span>
        <br/>
    </p>
    <p>
        <strong>5. คุณสมบัติของการสมัครเข้าร่วมเป็นสมาชิกกองทุนอิสระฯ</strong> ตามโครงการช่วยเหลือแก้ไขหนี้สินแบบปลอดดอกเบี้ย
        <span>5.1เป็นบุคคลที่มีอายุตั้งแต่ 20 ปีขึ้นไป ทั้งคนไทยหรือบุคคลต่างด้าวที่ทำงานและมีที่พักอาศัยอยู่ในประเทศไทยมาเป็นระยะเวลาไม่น้อยกว่าสองปี</span>
        <span>5.2 เป็นผู้มีนิสัยอันดีงาม มีความรู้  ความเข้าใจ  เห็นชอบด้วยหลักการ ระเบียบข้อบังคับ และการดำเนินงานบริหารของกองทุนอิสระฯ  และสมัครใจเข้ามามีส่วนร่วมในกิจกรรมต่าง ๆ ของกองทุนอิสระฯ</span>
        <span>5.3 เป็นผู้ถึงพร้อมที่จะต้องปฏิบัติตามระเบียบข้อบังคับของกองทุนอิสระฯ อย่างเคร่งครัด</span>
        <span>5.4 เป็นผู้ที่คณะกรรมการกองทุนอิสระฯ ได้มีมติเห็นชอบให้เข้าร่วมเป็นสมาชิกกองทุนอิสระฯ</span>
        <span>5.5 มีความอดทนรู้จักเสียสละและเห็นแก่ประโยชน์ส่วนรวมและสมาชิกของกองทุนอิสระฯ เป็นสำคัญ</span>
        <span>5.6 เป็นผู้ที่สามารถมีความตั้งมั่นในการฝากเงินสัจจะออมทรัพย์เพื่ออนาคตตัวเอง และครอบครัวตามสัญญาอย่างเคร่งครัด</span>
        <span>5.7 ผู้ที่สมัครเข้าร่วมเป็นสมาชิกกองทุนอิสระฯ ในปีแรกจะต้องไม่เคยเป็นผู้ที่ค้างชำระหนี้ในกองทุนอื่นๆ หากยังค้างชำระ  ให้ตัดสิทธิ์ในการได้รับการพิจารณาอนุมัติจากกองทุนอิสระฯ จนกว่าจะชำระหนี้ที่ค้างอยู่ให้เสร็จสิ้น ( ยกเว้นกรณีที่เป็นผู้สมัครรายใหม่ ที่มีความจำนงเข้าร่วมในโครงการนี้เท่านั้น) ทั้งนี้ผู้สมัครที่ถูกตัดสิทธิ์เมื่อความปรากฏในภายหลังว่า  ปกปิดว่าเป็นหนี้กองทุนอื่นอยู่  ผู้สมัครจะไม่ได้รับค่าสมัครแรกเข้า และค่าธรรมเนียมรายปีคืนแต่อย่างใด เว้นแต่กองทุนอิสระฯ อนุญาตเป็นการเฉพาะราย โดยให้ขึ้นอยู่กับดุลพินิจของประธานกองทุนอิสระฯ</span>
        <br/>
    </p>
    <p>
        <strong>6. การสมัครขอเข้าร่วมเป็นสมาชิกกองทุนอิสระฯ</strong> โครงการช่วยเหลือแก้ไขหนี้สินแบบปลอดดอกเบี้ย ด้วยความสมัครใจ
        <span>6.1 ยื่นใบสมัครเป็นสมาชิกกองทุนอิสระฯ  สามารถยื่นความจำนงได้ที่คณะกรรมการกองทุนอิสระฯ หรือตัวแทนของคณะกรรมการกองทุนอิสระฯ ระดับจังหวัด /อำเภอ ที่กองทุนอิสระฯ แต่งตั้งขึ้นและมอบหมายให้ปฏิบัติหน้าที่</span>
        <span>6.2 ผู้มีคุณสมบัติตามข้อ 5 สามารถยื่นความจำนง หรือสมัครเข้าเป็นสมาชิกของกองทุนอิสระฯ ได้ (เดือนละ 1 ครั้ง หรือปีละ 1 ครั้ง) โดยสามารถสมัครเข้าร่วมเป็นสมาชิกกองทุนอิสระฯ ได้โดยปัจเจกบุคคล และกลุ่มองค์กรชุมชน  แล้วแต่ต้องเป็นไปด้วยความสมัครใจของผู้ที่ต้องการเป็นสมาชิกกองทุนอิสระฯ เท่านั้น ทั้งนี้โดยไม่มีการบังคับขู่เข็นใด ๆ และผู้สมัครยินดียกเงินค่าสมัครแรกเข้า ค่าธรรมเนียมบำรุงรายปีตลอดจนค่าใช้จ่ายอื่นๆ ที่เกี่ยวข้องให้กับกองทุนอิสระฯเพื่อช่วยเหลือเพื่อนสมาชิกกองทุนอิสระฯ รายอื่นต่อไปโดยตกลงที่จะไม่ขอรับเงินคืนในทุกกรณี  ยกเว้นว่ากองทุนอิสระฯ จะเป็นผู้ผิดสัญญาก็ให้ผู้สมัครเรียกร้องเงินค่าสมัครแรกเข้าและค่าธรรมเนียมอื่นๆ ที่สมาชิกของกองทุนอิสระฯ ได้จ่ายให้กับกองทุนอิสระฯ ตามกำหนดระยะเวลาที่กองทุนอิสระฯ กำหนดแต่จะต้องไม่เกิน 3 เดือน</span>
        <span>6.3 คณะกรรมการกองทุนอิสระฯ จะเป็นผู้พิจารณาว่าจะรับบุคคลหนึ่งบุคคลใด เข้าเป็นสมาชิกกองทุนอิสระฯหรือไม่ โดยความชอบธรรม</span>
    </p>
    <p><strong>7. เมื่อคณะกรรมการกองทุนอิสระฯ</strong> ได้ดำเนินการประชุมพิจารณาคุณสมบัติของการสมัครเข้าร่วมเป็นสมาชิกกองทุนอิสระฯ ตาม ข้อ 5  และเห็นสมควรรับบุคคลใดเข้าเป็นสมาชิกกองทุนอิสระฯ จะแจ้งบุคคลที่เป็นสมาชิกกองทุนอิสระฯ นั้นให้ชำระค่าธรรมเนียมแรกเข้า ค่าบำรุงสมาชิกกองทุนอิสระฯ รายปี และเงินฝากสัจจะออมทรัพย์กองทุนอิสระฯ เดือนแรก ส่วนเงินฝากสัจจะออมทรัพย์เดือนถัดไปนั้น  สมาชิกกองทุนอิสระฯ จะต้องชำระหนี้ตามเงื่อนไขข้อตกลงที่ได้รับการแก้ไขหนี้สินเรียบร้อยแล้ว  โดยต้องคืนให้กับกองทุนอิสระฯ ตามสัญญา   หลังจากที่กองทุนอิสระฯ ดำเนินการซื้อหนี้สินของสมาชิกกองทุนอิสระฯ เสร็จสิ้น ทุกเดือนตามจำนวน ข้อ 11.3 เป็นระยะเวลา 120 เดือน หรือ ระยะเวลา 10  ปี หากสมาชิกกองทุนอิสระฯ ไม่ปฏิบัติตามเงื่อนสัญญา  จะต้องชำระหนี้คืนกองทุนอิสระฯ เต็มจำนวนในครั้งแรกที่ได้เคยระบุไว้ในมูลหนี้ก่อนที่จะได้รับการช่วยเหลือแก้ไขหนี้แบบปลอดดอกเบี้ย ในครั้งแรกตามที่เอกสารหลักฐานระบุไว้ พร้อมดอกเบี้ยร้อยละ 7.5 ต่อปีของต้นเงินดังกล่าว นับตั้งแต่วันที่กองทุนซื้อหนี้ไป เว้นแต่ประธานกองทุนอิสระฯ จะไม่คิดดอกเบี้ยทั้งนี้ให้เป็นดุลยพินิจของประธานกองทุนอิสระฯ เป็นรายๆไป</p>
    <p>
        <strong>8. สมาชิกกองทุนอิสระฯ</strong> ขาดหรือพ้นสภาพจากการเป็นสมาชิกกองทุนอิสระฯ ตามเหตุต่างๆ ดังนี้
        <span>8.1 ตาย</span>
        <span>8.2 ลาออก และได้รับอนุมัติให้ลาออกจากคณะกรรมการกองทุนอิสระฯ</span>
        <span>8.3 วิกลจริต จิตฟั่นเฟือน หรือถูกศาลสั่งให้เป็นผู้ไร้ความสามารถ</span>
        <span>8.4 ที่ประชุมใหญ่กองทุนอิสระฯมีมติให้ออกด้วยคะแนนเสียงสองในสามของผู้เข้าร่วมประชุม</span>
        <span>8.5 จงใจฝ่าฝืนระเบียบของกองทุนอิสระฯ หรือแสดงตนเป็นปรปักษ์ หรือไม่ให้ความช่วยเหลือ หรือร่วมมือกับกองทุนอิสระฯ  ไม่ว่าด้วยประการใด</span>
        <span>8.6 มีเจตนาจงใจปิดบังความจริงอันควรแจ้งให้กองทุนอิสระฯ ทราบในใบสมัครสมาชิกกองทุนอิสระฯ</span>
        <span>8.7 มีเจตนาหรือจงใจ นำทรัพย์สินของกองทุนอิสระฯ ที่ได้รับไปใช้ผิดวัตถุประสงค์ที่ระบุไว้</span>
        <span>8.8 มีลักษณะหรือคุณสมบัติไม่ตรงกับข้อ 5</span>
    </p>
    <p><strong>9. สมาชิกกองทุนอิสระฯ</strong>ที่ไม่มีหนี้สินหรือพันธะผูกพันใด ๆ กับกองทุนอิสระฯ ทั้งในฐานะผู้กู้ยืมหรือผู้ค้ำประกัน เมื่อครบกำหนดตามสัญญาตามที่กองทุนอิสระฯ ได้ดำเนินการซื้อหนี้เรียบร้อยแล้ว หรือสมาชิกกองทุนอิสระฯ ที่สมัครเข้าเป็นสมาชิกรายใหม่ ไม่ประสงค์เข้าร่วมกับกองทุนอิสระฯ  สามารถยื่นความจำนงขอลาออกจากการเป็นสมาชิกของกองทุนอิสระฯ ได้ หลังจากที่สมัครเข้าร่วมเป็นสมาชิกกองทุนอิสระฯ ครบ 6 เดือนเป็นต้นไป ได้โดยแสดงความจำนงเป็นหนังสือยื่นต่อคณะกรรมการกองทุนอิสระฯ เพื่อพิจารณาอนุญาต และให้ขาดจากการเป็นสมาชิกภาพกองทุนอิสระฯ ภายใน 3 วัน นับตั้งแต่ในวันที่คณะกรรมการกองทุนอิสระฯ มีคำสั่งอนุญาต ทั้งนี้เพื่อดำเนินการตรวจสอบความถูกต้อง และคืนเงินฝากสัจจะออมทรัพย์เท่านั้น ให้กับสมาชิกกองทุนอิสระฯ รายใหม่ที่ลาออกทุกราย โดยกองทุนอิสระฯ ขอสงวนสิทธิ์ในการไม่คืนเงิน ค่าธรรมเนียมแรกเข้า จำนวน 500 บาท และเงินค่าธรรมเนียมบำรุงรายปี จำนวน 2,000 บาท โดยผู้สมัครสมาชิกกองทุนอิสระฯ  ดังกล่าวตกลงและยินยอมที่จะไม่ขอรับเงินจำนวนดังกล่าวคืน  ทั้งนี้เพื่อให้กองทุนอิสระฯ นำเงินจำนวนดังกล่าวไว้เป็นทุนให้กับสมาชิกกองทุนอิสระฯ รายต่อ ๆ ไปเพื่อให้ได้รับการแก้ไขหนี้สินด้วยวิธีซื้อหนี้ต่อไป</p>
    <p><strong>10. ผู้ที่ขาดจากการเป็นสมาชิกภาพ</strong>อาจยื่นคำขอเป็นสมาชิกกองทุนอิสระฯ ใหม่ได้ แต่ทั้งนี้จะต้องเป็นผู้ขาดจากสมาชิกกองทุนอิสระฯ ติดต่อกันไม่น้อยกว่า 3 ปี  หรือตามที่คณะกรรมการกองทุนอิสระฯ มีมติเห็นชอบ</p>
    <p>
        <strong>11. การคิดค่าธรรมเนียมในการสมัครเข้าเป็นสมาชิกกองทุนอิสระฯ</strong> ตามโครงการช่วยเหลือแก้ไขหนี้สินแบบปลอดดอกเบี้ย
        <span>11.1 ค่าธรรมเนียมแรกเข้า จำนวน 500 บาท</span>
        <br/>
        <span>11.2 ค่าบำรุงสมาชิกรายปี จำนวน 2,000 บาท</span>
        <br/>
        <span>11.3 เงินฝากสัจจะออมทรัพย์ จำนวนดังต่อไปนี้</span>
        <br/>
        <span>11.3.1 จำนวนมูลหนี้ต่ำกว่า 431,999 บาท ÷ 120 = จำนวนเงินฝากสัจจะออมทรัพย์ต่อเดือน</span>
        <br/>
        <span>11.3.2 จำนวนมูลหนี้ 432,000 บาท ขึ้นไป เงินฝากสัจจะออมทรัพย์ 3,600 บาทต่อเดือน</span>
    </p>
    <p><strong>12. ค่าธรรมเนียมแรกเข้า จำนวน 500 บาท</strong>ตามที่สมาชิกกองทุนอิสระฯ ได้ชำระเงินไว้ในวันที่สมัครเข้าร่วมเป็นสมาชิก  ทั้งที่เป็นปัจเจกบุคคล กลุ่มหรือองค์กรชุมชน  นับจากวันที่ยื่นใบสมัครขอเข้าร่วมเป็นสมาชิกกองทุนอิสระฯ นั้น ซึ่งหากสมาชิกกองทุนอิสระฯ ลาออก ให้ออก หรือไล่ออก จะไม่ได้รับเงินค่าธรรมเนียมแรกเข้าคืนทุกกรณี โดยผู้สมัครสมาชิกกองทุนอิสระฯ ตกลงและยินยอม ทั้งนี้เพื่อให้กองทุนอิสระฯนำเงินจำนวนดังกล่าวไปเป็นทุนช่วยเหลือสมาชิกกองทุนอิสระฯ รายอื่นๆ ต่อไปตามโครงการของกองทุนอิสระฯนี้</p>
    <p><strong>13. การคิดค่าธรรมเนียมบำรุงสมาชิกกองทุนอิสระฯ รายปี ๆ ละ 2,000 บาท</strong>สมาชิกกองทุนอิสระฯ แรกเข้าตามข้อ 5 ตกลงให้ความยินยอมโดยสมัครใจที่จะชำระค่าธรรมเนียมบำรุงสมาชิกกองทุนอิสระฯ รายปี เพื่อนำมาสบทบเป็นทุนหมุนเวียนในการใช้จ่ายในการจัดระบบสิทธิประโยชน์สวัสดิการสงเคราะห์ ให้กับสมาชิกกองทุนอิสระฯ ทั้งหมดที่มีอยู่   ตลอดจนการดำเนินการบริหารงานกองทุนอิสระฯ ต่าง ๆ ของกองทุนอิสระฯ  ตลอดจนให้ความยินยอมให้คณะกรรมการกองทุนอิสระฯ สามารถนำเงินดังกล่าวไปใช้ในโครงการต่างๆให้เป็นไปตามนโยบายของกองทุนอิสระฯ กำหนด  โดยไม่ต้องแจ้งให้สมาชิกกองทุนอิสระฯ ทราบแต่ประการใด เพื่อเป็นประโยชน์แก่สมาชิกกองทุนอิสระฯ ทั้งมวล</p>
    <p><strong>14. วิธีการชำระเงินฝากสัจจะออมทรัพย์</strong>ตามสัญญาซื้อหนี้สิน ในโครงการช่วยเหลือแก้ไขหนี้สินแบบปลอดดอกเบี้ย ที่ได้ทำสัญญาไว้กับกองทุนอิสระฯ ตามระยะเวลาที่กำหนดไว้ในสัญญา โดยต้องชำระเป็นรายเดือน ทุกวันที่ 5 ของเดือน เป็นระยะเวลา 120 เดือน ซึ่งสมาชิกกองทุนอิสระฯ ต้องชำระเงินฝากสัจจะออมทรัพย์ ไว้กับกองทุนอิสระฯ โดยสามารถจ่ายเป็นเงินสด หรือโอนเข้าบัญชีที่กองทุนอิสระฯ ตามที่กำหนดไว้ โดยผู้สมัครใจเข้าเป็นสมาชิกกองทุนอิสระฯ ทุกคน จะต้องส่งเงินฝากสัจจะออมทรัพย์งวดแรก จำนวนเงินตามข้อ 11.3 โดยถือว่าเงินฝากสัจจะออมทรัพย์เป็นเงินออมระยะยาวหรือเงินฝากสัจจะออมทรัพย์ ที่เป็นการชำระหนี้สินเงินกู้ยืมคืนกองทุนอิสระฯ และสมาชิกกองทุนอิสระฯ จะได้รับเงินที่ฝากสัจจะออมทรัพย์คืน หรือปิดบัญชีได้ต่อเมื่อครบสัญญาที่ทำไว้กับกองทุนอิสระฯ หรือการพ้นสภาพจากการเป็นสมาชิกกองทุน อิสระฯ เท่านั้น</p>
    <p>
        <span>
            <strong>15. กรณีที่ข้าพเจ้าถึงแก่ความตายในระหว่างที่เป็นสมาชิกกองทุนอิสระฯ</strong> ข้าพเจ้าขอแสดงเจตนารมย์ให้กองทุนอิสระฯ จ่ายเงินฌาปนกิจสงเคราะห์ 50,000 บาท และหรือผลประโยชน์อย่างอื่นที่ข้าพเจ้าพึงได้รับตามสิทธิของการเป็นสมาชิกกองทุนอิสระฯ ให้แก่ผู้รับโอนผลประโยชน์ของข้าพเจ้า ดังต่อไปนี้
        </span>
        <br/>
        <span>{{ __('ชื่อ') . Str::padLeft($member->benef_title, strlen($member->benef_title) + 5, '.') . Str::padRight($member->benef_firstname, strlen($member->benef_firstname) + 5, '.') }}</span>
        <span>{{ __('นามสกุล') . Str::padBoth($member->benef_lastname, strlen($member->benef_lastname) + 10, '.')}}</span>
        <span>{{ __('บัตรประจำตัวประชาชนเลขที่') . Str::padBoth($member->benef_id_card_no, strlen($member->benef_id_card_no) + 10, '.')}}</span>
        <br/>
        <span>{{ __('มีความสัมพันธ์เป็น') . Str::padBoth($member->benef_relationship, strlen($member->benef_relationship) + 10, '.')}}</span>
        <span>{{ __('เลขที่') . Str::padBoth($member->benef_house_no, strlen($member->benef_house_no) + 10, '.')}}</span>
        <span>{{ __('หมู่ที่') . Str::padBoth($member->benef_moo, strlen($member->benef_moo) + 10, '.')}}</span>
        <span>{{ __('ตรอก/ซอย') . Str::padBoth($member->benef_soi, strlen($member->benef_soi) + 10, '.')}}</span>
        <br/>
        <span>{{ __('ถนน') . Str::padBoth($member->benef_street, strlen($member->benef_street) + 10, '.')}}</span>
        <span>{{ __('ตำบล/แขวง') . Str::padBoth($member->benef_sub_district, strlen($member->benef_sub_district) + 10, '.')}}</span>
        <span>{{ __('อำเภอ') . Str::padBoth($member->benef_district, strlen($member->benef_district) + 20, '.')}}</span>
        <span>{{ __('จังหวัด') . Str::padBoth($member->benef_province, strlen($member->benef_province) + 20, '.')}}</span>
        <br/>
        <span>{{ __('รหัสไปรษณีย์') . Str::padBoth($member->benef_postcode, strlen($member->benef_postcode) + 20, '.')}}</span>
        <span>{{ __('โทรศัพท์') . Str::padBoth($member->benef_tel, strlen($member->benef_tel) + 20, '.')}}</span>
        <span>{{ __('E-mail') . Str::padBoth($member->benef_fax, strlen($member->benef_fax) + 20, '.')}}</span>
    </p>
    <p>ข้าพเจ้าได้อ่านข้อความทั้งหมดจนเป็นที่เข้าใจเป็นอย่างดีแล้ว และขอรับรองว่าข้อความทั้งหมดที่ข้าฯ ได้ระบุไว้ ในใบสมัครหรือสัญญาฉบับนี้  เป็นข้อมูลจริงทุกประการ และข้าฯยินยอมให้กองทุนอิสระฯ ตลอดจนตัวแทนกองทุนอิสระฯ  และเจ้าหนี้ที่เข้าร่วมโครงการช่วยเหลือแก้ไขหนี้สินแบบปลอดดอกเบี้ยนี้ดำเนินการตรวจสอบข้อมูล ขอข้อมูลและเปิดเผยข้อมูล ตลอดจนใช้ข้อมูลเกี่ยวกับภาระหนี้หลักประกัน  และหรือการได้รับสินเชื่อของข้าพเจ้าที่มีอยู่กับสถาบันการเงินสมาชิกหรือนิติบุคคลอื่น ที่ได้ถูกรวบรวมไว้ที่บริษัทข้อมูลเครดิตแห่งชาติจำกัดหรือบริษัทข้อมูลเครดิตใดๆ ตามพระราชบัญญัติการประกอบธุรกิจข้อมูลเครดิตที่จะมีขึ้นต่อไปในภายหน้าได้ทั้งสิ้น ทั้งนี้ไม่ว่าจะเป็นภาระหนี้  และ/หรือวงเงินสินเชื่อที่ข้าพเจ้าเคยมีในอดีต  และ/หรือที่มีอยู่ในปัจจุบันตลอดจนที่จะมีขึ้นในภายหน้าโดยไม่ต้องคำนึงว่าข้าพเจ้าจะได้รับอนุมัติให้เข้าร่วมโครงการหรือไม่ก็ตาม โดยข้าฯ จะไม่นำเอกสารหรือบันทึกข้อความใดๆ ที่เกี่ยวข้องไปฟ้องร้อง  เรียกร้อง  ค่าเสียหายใดๆ ได้ ทั้งตามประมวลกฎหมายแพ่งและพาณิชย์  หรือ ประมวลกฎหมายอาญา  หรือตามกฎหมายอื่นๆ ทุกกรณี หรือไม่ติดใจเรียกร้อง หรือเอาความใดๆ กับกองทุนอิสระฯ ตลอดจนผู้มีหน้าที่ดำเนินการแทนกองทุนอิสระฯ ไม่ทางแพ่ง หรืออาญา หรือกฎหมายอื่นใด</p>
    <p>ทั้งนี้ หากข้าฯได้รับการแก้ไขหนี้สินตามโครงการนี้ด้วยการซื้อหนี้สินเสร็จสิ้น อันทรัพย์สินใดๆ ของข้าฯที่ค้ำประกันไว้กับสถาบันการเงิน หรือเจ้าหนี้ของข้าฯไว้ ข้าฯตกลงยินยอมให้กองทุนอิสระฯ นำหลักทรัพย์ดังกล่าวมาใช้เป็นหลักค้ำประกัน หนี้สินตามสัญญาฉบับนี้ จนกว่าจะชำระหนี้สินให้กับกองทุนอิสระฯ เสร็จสิ้น โดยไม่มีเงื่อนไขแต่อย่างใด และยินยอมปฏิบัติตามเงื่อนไขทุกประการ</p>
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