@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>สมัครสมาชิก</h3>
                </div>
                <div class="card-body">
                    <form>
                        <h4 class="mb-3">ข้อมูลส่วนตัว</h4>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <label for="field_1_1">คำนำหน้า</label>
                                <select class="form-control" id="field_1_1" name="field_1_1">
                                    <option value="นาย">นาย</option>
                                    <option value="นาง">นาง</option>
                                    <option value="นางสาว">นางสาว</option>
                                </select>
                            </div>
                            <div class="form-group col-5">
                                <label for="field_1_2">ชื่อ</label>
                                <input type="text" class="form-control" id="field_1_2" name="field_1_2">
                            </div>
                            <div class="form-group col-5">
                                <label for="field_1_3">นามสกุล</label>
                                <input type="text" class="form-control" id="field_1_3" name="field_1_3">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-3">
                                <label for="field_1_4">บัตรประจำตัวประชาชนเลขที่</label>
                                <input type="text" class="form-control" id="field_1_4" name="field_1_4">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_5">บัตรข้าราชการ/บัตรพนักงานรัฐวิสาหกิจ</label>
                                <input type="text" class="form-control" id="field_1_5" name="field_1_5">
                            </div>
                            <div class="form-group col-2">
                                <label for="field_1_6">วันหมดอายุ (วว/ดด/ปปปป)</label>
                                <input type="text" class="form-control" id="field_1_6" name="field_1_6">
                            </div>
                            <div class="form-group col-1">
                                <label for="field_1_7">อายุ</label>
                                <input type="text" class="form-control" id="field_1_7" name="field_1_7">
                            </div>
                            <div class="form-group col-1">
                                <label for="field_1_8">สัญชาติ</label>
                                <input type="text" class="form-control" id="field_1_8" name="field_1_8">
                            </div>
                            <div class="form-group col-2">
                                <label for="field_1_9">โทรศัพท์</label>
                                <input type="text" class="form-control" id="field_1_9" name="field_1_9">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-3">
                                <label for="field_1_10">เป็นบุคคลล้มละลายหรือไม่</label>
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="field_1_10_1" name="field_1_10" value="เป็น">
                                        <label class="form-check-label" for="field_1_10_1">เป็น</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="field_1_10_2" name="field_1_10" value="ไม่เป็น">
                                        <label class="form-check-label" for="field_1_10_2">ไม่เป็น</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_11">คนไร้ความสามารถ</label>
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="field_1_11_1" name="field_1_11" value="ใช่">
                                        <label class="form-check-label" for="field_1_11_1">ใช่</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="field_1_11_2" name="field_1_11" value="ไม่ใช่">
                                        <label class="form-check-label" for="field_1_11_2">ไม่ใช่</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_12">ทุพพลภาพถาวร</label>
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="field_1_12_1" name="field_1_12" value="ใช่">
                                        <label class="form-check-label" for="field_1_12_1">ใช่</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="field_1_12_2" name="field_1_12" value="ไม่ใช่">
                                        <label class="form-check-label" for="field_1_12_2">ไม่ใช่</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_13">คนเสมือนไร้ความสามารถ</label>
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="field_1_13_1" name="field_1_13" value="ใช่">
                                        <label class="form-check-label" for="field_1_13_1">ใช่</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="field_1_13_2" name="field_1_13" value="ไม่ใช่">
                                        <label class="form-check-label" for="field_1_13_2">ไม่ใช่</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="field_1_14">สถานภาพสมรส</label>
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="field_1_14_1" name="field_1_14" value="โสด">
                                        <label class="form-check-label" for="field_1_14_1">โสด</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="field_1_14_2" name="field_1_14" value="หย่า">
                                        <label class="form-check-label" for="field_1_14_2">หย่า</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="field_1_14_3" name="field_1_14" value="สมรสจดทะเบียน">
                                        <label class="form-check-label" for="field_1_14_3">สมรสจดทะเบียน</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="field_1_14_4" name="field_1_14" value="สมรสไม่จดทะเบียน">
                                        <label class="form-check-label" for="field_1_14_4">สมรสไม่จดทะเบียน</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="field_1_14_5" name="field_1_14" value="หม้าย">
                                        <label class="form-check-label" for="field_1_14_5">หม้าย</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_15">จำนวนบุตร (คน)</label>
                                <input type="number" class="form-control" id="field_1_15" name="field_1_15">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_16">จำนวนบุตรที่กำลังศึกษาอยู่ (คน)</label>
                                <input type="number" class="form-control" id="field_1_16" name="field_1_16">
                            </div>
                        </div>
                        <h4 class="mb-3">ข้อมูลคู่สมรส</h4>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <label for="field_1_17">คำนำหน้า</label>
                                <select class="form-control" id="field_1_17" name="field_1_17">
                                    <option value="นาย">นาย</option>
                                    <option value="นาง">นาง</option>
                                    <option value="นางสาว">นางสาว</option>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_18">ชื่อ</label>
                                <input type="text" class="form-control" id="field_1_18" name="field_1_18">
                            </div>
                            <div class="form-group col-4">
                                <label for="field_1_19">นามสกุล</label>
                                <input type="text" class="form-control" id="field_1_19" name="field_1_19">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_20">บัตรประจำตัวประชาชนเลขที่</label>
                                <input type="text" class="form-control" id="field_1_20" name="field_1_20">
                            </div>
                        </div>
                        <h5 class="mb-3">ที่อยู่ตามทะเบียนบ้าน</h5>
                        <div class="form-row">
                            <div class="form-group col-3">
                                <label for="field_1_21">บ้านเลขที่</label>
                                <input type="text" class="form-control" id="field_1_21" name="field_1_21">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_22">หมู่ที่</label>
                                <input type="text" class="form-control" id="field_1_22" name="field_1_22">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_23">ตรอก/ซอย</label>
                                <input type="text" class="form-control" id="field_1_23" name="field_1_23">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_24">ถนน</label>
                                <input type="text" class="form-control" id="field_1_24" name="field_1_24">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-3">
                                <label for="field_1_25">ตำบล/แขวง</label>
                                <input type="text" class="form-control" id="field_1_25" name="field_1_25">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_26">อำเภอ/เขต</label>
                                <input type="text" class="form-control" id="field_1_26" name="field_1_26">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_27">จังหวัด</label>
                                <select class="form-control" id="field_1_27" name="field_1_27">
                                    @foreach ($provinces as $province)
                                    <option value="{{ $province->name_th }}">{{ $province->name_th }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_28">รหัสไปรษณีย์</label>
                                <input type="text" class="form-control" id="field_1_28" name="field_1_28">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="field_1_29">โทรศัพท์</label>
                                <input type="text" class="form-control" id="field_1_29" name="field_1_29">
                            </div>
                            <div class="form-group col-4">
                                <label for="field_1_30">โทรสาร</label>
                                <input type="text" class="form-control" id="field_1_30" name="field_1_30">
                            </div>
                            <div class="form-group col-4">
                                <label for="field_1_31">อีเมล</label>
                                <input type="text" class="form-control" id="field_1_31" name="field_1_31">
                            </div>
                        </div>
                        <h5 class="mb-3">ที่อยู่จัดส่งเอกสาร</h5>
                        <div class="form-row">
                            <div class="form-group col-3">
                                <label for="field_1_32">บ้านเลขที่</label>
                                <input type="text" class="form-control" id="field_1_32" name="field_1_32">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_33">หมู่ที่</label>
                                <input type="text" class="form-control" id="field_1_33" name="field_1_33">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_34">ตรอก/ซอย</label>
                                <input type="text" class="form-control" id="field_1_34" name="field_1_34">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_35">ถนน</label>
                                <input type="text" class="form-control" id="field_1_35" name="field_1_35">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-3">
                                <label for="field_1_36">ตำบล/แขวง</label>
                                <input type="text" class="form-control" id="field_1_36" name="field_1_36">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_37">อำเภอ/เขต</label>
                                <input type="text" class="form-control" id="field_1_37" name="field_1_37">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_38">จังหวัด</label>
                                <select class="form-control" id="field_1_38" name="field_1_38">
                                    @foreach ($provinces as $province)
                                    <option value="{{ $province->name_th }}">{{ $province->name_th }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_39">รหัสไปรษณีย์</label>
                                <input type="text" class="form-control" id="field_1_39" name="field_1_39">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-3">
                                <label for="field_1_40">โทรศัพท์</label>
                                <input type="text" class="form-control" id="field_1_40" name="field_1_40">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_41">อีเมล</label>
                                <input type="text" class="form-control" id="field_1_41" name="field_1_41">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_42">ID Line</label>
                                <input type="text" class="form-control" id="field_1_42" name="field_1_42">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_43">Facebook</label>
                                <input type="text" class="form-control" id="field_1_43" name="field_1_43">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-3">
                                <label for="field_1_44">ที่อยู่อาศัยปัจจุบัน</label>
                                <select class="form-control" id="field_1_44" name="field_1_44">
                                    <option value="บ้านตนเองปลอดภาระ">บ้านตนเองปลอดภาระ</option>
                                    <option value="บ้านตนเองปลอดภาระ">บ้านของมิดามารดา</option>
                                    <option value="บ้านตนเองปลอดภาระ">บ้านของญาติ</option>
                                    <option value="บ้านตนเองปลอดภาระ">บ้านพักสวัสดิการ</option>
                                    <option value="บ้านตนเองปลอดภาระ">บ้านตนเองและผ่อนอยู่กับสถาบันการเงิน</option>
                                    <option value="บ้านตนเองปลอดภาระ">บ้านเช่า</option>
                                </select>
                            </div>
                            <div class="form-group col-2">
                                <label for="field_1_45">ผ่อนชำระ/ค่าเช่า (ต่อเดือน)</label>
                                <input type="text" class="form-control" id="field_1_45">
                            </div>
                            <div class="form-group col-2">
                                <label for="field_1_46">อาศัยอยู่เป็นเวลา (ปี)</label>
                                <input type="text" class="form-control" id="field_1_46">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_47">ระดับการศึกษาสูงสุด</label>
                                <select class="form-control" id="field_1_47" name="field_1_47">
                                    <option value="ต่ำกว่ามัธยมศึกษาตอนปลาย">ต่ำกว่ามัธยมศึกษาตอนปลาย</option>
                                    <option value="มัธยมศึกษาตอนปลาย">มัธยมศึกษาตอนปลาย</option>
                                    <option value="อนุปริญญา">อนุปริญญา</option>
                                    <option value="ปวช./ปวส.">ปวช./ปวส.</option>
                                    <option value="ปริญญาตรี">ปริญญาตรี</option>
                                    <option value="ปริญญาโท">ปริญญาโท</option>
                                    <option value="ปริญญาเอก">ปริญญาเอก</option>
                                    <option value="อื่นๆ">อื่นๆ</option>
                                </select>
                            </div>
                            <div class="form-group col-2">
                                <label for="field_1_48">อื่นๆ</label>
                                <input type="text" class="form-control" id="field_1_48">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-3">
                                <label for="field_1_49">สาขาอาชีพ</label>
                                <select class="form-control" id="field_1_47" name="field_1_49">
                                    <option value="ข้าราชการประจำ">ข้าราชการประจำ</option>
                                    <option value="ข้าราชการบำนาญ">ข้าราชการบำนาญ</option>
                                    <option value="ข้าราชการบำเหน็จ">ข้าราชการบำเหน็จ</option>
                                    <option value="พนักงานรัฐวิสาหกิจ">พนักงานรัฐวิสาหกิจ</option>
                                    <option value="นักเรียน/นักศึกษา">นักเรียน/นักศึกษา</option>
                                    <option value="เกษตรกร">เกษตรกร</option>
                                    <option value="ลูกจ้างประจำ">ลูกจ้างประจำ</option>
                                    <option value="ค้าขาย">ค้าขาย</option>
                                    <option value="พนักงานเอกชน">พนักงานเอกชน</option>
                                    <option value="อื่นๆ">อื่นๆ</option>
                                </select>
                            </div>
                            <div class="form-group col-2">
                                <label for="field_1_50">อื่นๆ</label>
                                <input type="text" class="form-control" id="field_1_50">
                            </div>
                        </div>
                        <h4 class="mb-3">รายได้</h4>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <label for="field_2_1">รายได้ประจำ</label>
                                <select class="form-control" id="field_1_47" name="field_2_1">
                                    <option value="เงินเดือน/เงินบำนาญ/เงินรายได้">เงินเดือน/เงินบำนาญ/เงินรายได้</option>
                                    <option value="เงินค่าจ้าง/เงินค่าตอบแทน">เงินค่าจ้าง/เงินค่าตอบแทน</option>
                                </select>
                            </div>
                            <div class="form-group col-2">
                                <label for="field_2_2">จำนวน (บาท/เดือน)</label>
                                <input type="number" class="form-control" id="field_2_2">
                            </div>
                            <div class="form-group col-2">
                                <label for="field_2_3">รายได้อื่นๆ</label>
                                <select class="form-control" id="field_1_47" name="field_2_3">
                                    <option value="ค่าล่วงเวลา">ค่าล่วงเวลา</option>
                                    <option value="ค่าคอมมิชชั่น">ค่าคอมมิชชั่น</option>
                                    <option value="อื่นๆ">อื่นๆ</option>
                                </select>
                            </div>
                            <div class="form-group col-2">
                                <label for="field_2_4">อื่นๆ (โปรดระบุ)</label>
                                <input type="text" class="form-control" id="field_2_4">
                            </div>
                            <div class="form-group col-2">
                                <label for="field_2_5">จำนวน (บาท/เดือน)</label>
                                <input type="number" class="form-control" id="field_2_5">
                            </div>
                            <div class="form-group col-2">
                                <label for="field_2_6">แหล่งที่มา</label>
                                <input type="text" class="form-control" id="field_2_6">
                            </div>
                        </div>
                        <h4 class="mb-3">ภาระหนี้กับสถาบันการเงิน/บริษัท/หนี้นอกระบบ</h4>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="field_3_1" id="field_3_1_1" value="1">
                                    <label class="form-check-label" for="field_3_1_1">เอกสารมูลหนี้สินตามความเป็นจริงทั้งในระบบและนอกระบบ</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="field_3_1" id="field_3_1_2" value="2">
                                    <label class="form-check-label" for="field_3_1_2">เอกสารการตรวจเครดิตบูโร</label>
                                </div>
                            </div>
                        </div>
                        <h4 class="mb-3">สถานทีทำงาน</h4>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="field_4_1">ชื่อสถานที่ทำงาน</label>
                                <input type="text" class="form-control" id="field_4_1" name="field_4_1">
                            </div>
                            <div class="form-group col-4">
                                <label for="field_4_2">อาคาร</label>
                                <input type="text" class="form-control" id="field_4_2" name="field_4_2">
                            </div>
                            <div class="form-group col-1">
                                <label for="field_4_3">ชั้น</label>
                                <input type="number" class="form-control" id="field_4_3" name="field_4_3">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_4_4">แผนก/ฝ่าย</label>
                                <input type="text" class="form-control" id="field_4_4" name="field_4_4">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <label for="field_4_5">เลขที่</label>
                                <input type="text" class="form-control" id="field_4_5" name="field_4_5">
                            </div>
                            <div class="form-group col-2">
                                <label for="field_4_6">หมู่ที่</label>
                                <input type="text" class="form-control" id="field_4_6" name="field_4_6">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_4_7">ตรอก/ซอย</label>
                                <input type="text" class="form-control" id="field_4_7" name="field_4_7">
                            </div>
                            <div class="form-group col-5">
                                <label for="field_4_8">ถนน</label>
                                <input type="text" class="form-control" id="field_4_8" name="field_4_8">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="field_4_9">ตำบล/แขวง</label>
                                <input type="text" class="form-control" id="field_4_9" name="field_4_9">
                            </div>
                            <div class="form-group col-4">
                                <label for="field_4_10">อำเภอ/เขต</label>
                                <input type="text" class="form-control" id="field_4_10" name="field_4_10">
                            </div>
                            <div class="form-group col-2">
                                <label for="field_4_11">จังหวัด</label>
                                <select class="form-control" id="field_4_11" name="field_4_11">
                                    @foreach ($provinces as $province)
                                    <option value="{{ $province->name_th }}">{{ $province->name_th }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-2">
                                <label for="field_4_12">รหัสไปรษณีย์</label>
                                <input type="text" class="form-control" id="field_4_12" name="field_4_12">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <label for="field_4_13">โทรศัพท์</label>
                                <input type="text" class="form-control" id="field_4_13" name="field_4_13">
                            </div>
                            <div class="form-group col-2">
                                <label for="field_4_14">โทรสาร</label>
                                <input type="text" class="form-control" id="field_4_14" name="field_4_14">
                            </div>
                            <div class="form-group col-2">
                                <label for="field_4_15">อายุงานปัจจุบัน (ปี/เดือน)</label>
                                <input type="text" class="form-control" id="field_4_15" name="field_4_15">
                            </div>
                            <div class="form-group col-6">
                                <label for="field_4_16">ชื่อตำแหน่งงาน</label>
                                <input type="text" class="form-control" id="field_4_16" name="field_4_16">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="field_4_17">กรณีที่ผู้มีรายได้ประจำ อายุงานไม่ถึง 6 เดือน โปรดระบุชื่อสถานที่ทำงานเดิม</label>
                                <input type="text" class="form-control" id="field_4_17" name="field_4_17">
                            </div>
                        </div>
                        <h4 class="mb-3">ผู้รับโอนผลประโยชน์ของข้าพเจ้า</h4>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <label for="field_5_1">คำนำหน้า</label>
                                <select class="form-control" id="field_5_1" name="field_5_1">
                                    <option value="นาย">นาย</option>
                                    <option value="นาง">นาง</option>
                                    <option value="นางสาว">นางสาว</option>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_2">ชื่อ</label>
                                <input type="text" class="form-control" id="field_1_2" name="field_1_2">
                            </div>
                            <div class="form-group col-4">
                                <label for="field_1_3">นามสกุล</label>
                                <input type="text" class="form-control" id="field_1_3" name="field_1_3">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_1_4">บัตรประจำตัวประชาชนเลขที่</label>
                                <input type="text" class="form-control" id="field_1_4" name="field_1_4">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <label for="field_4_5">เลขที่</label>
                                <input type="text" class="form-control" id="field_4_5" name="field_4_5">
                            </div>
                            <div class="form-group col-2">
                                <label for="field_4_6">หมู่ที่</label>
                                <input type="text" class="form-control" id="field_4_6" name="field_4_6">
                            </div>
                            <div class="form-group col-3">
                                <label for="field_4_7">ตรอก/ซอย</label>
                                <input type="text" class="form-control" id="field_4_7" name="field_4_7">
                            </div>
                            <div class="form-group col-5">
                                <label for="field_4_8">ถนน</label>
                                <input type="text" class="form-control" id="field_4_8" name="field_4_8">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="field_4_9">ตำบล/แขวง</label>
                                <input type="text" class="form-control" id="field_4_9" name="field_4_9">
                            </div>
                            <div class="form-group col-4">
                                <label for="field_4_10">อำเภอ/เขต</label>
                                <input type="text" class="form-control" id="field_4_10" name="field_4_10">
                            </div>
                            <div class="form-group col-2">
                                <label for="field_4_11">จังหวัด</label>
                                <select class="form-control" id="field_4_11" name="field_4_11">
                                    @foreach ($provinces as $province)
                                    <option value="{{ $province->name_th }}">{{ $province->name_th }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-2">
                                <label for="field_4_12">รหัสไปรษณีย์</label>
                                <input type="text" class="form-control" id="field_4_12" name="field_4_12">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary">บันทึกข้อมูล</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
