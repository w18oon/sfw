@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">ข้อมูลสมาชิก</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" data-toggle="pill" href="#v-pills-personal-info" role="tab" aria-selected="true">ข้อมูลส่วนตัว</a>
                                <a class="nav-link" data-toggle="pill" href="#v-pills-spouse" role="tab" aria-selected="false">ข้อมูลคู่สมรส</a>
                                <a class="nav-link" data-toggle="pill" href="#v-pills-addr" role="tab" aria-selected="false">ที่อยู่ตามทะเบียนบ้าน</a>
                                <a class="nav-link" data-toggle="pill" href="#v-pills-ship" role="tab" aria-selected="false">ที่อยู่จัดส่งเอกสาร</a>
                                <a class="nav-link" data-toggle="pill" href="#v-pills-income" role="tab" aria-selected="false">รายได้</a>
                                <a class="nav-link" data-toggle="pill" href="#v-pills-debt" role="tab" aria-selected="false">ภาระหนี้</a>
                                <a class="nav-link" data-toggle="pill" href="#v-pills-work" role="tab" aria-selected="false">สถานทีทำงาน</a>
                                <a class="nav-link" data-toggle="pill" href="#v-pills-benef" role="tab" aria-selected="false">ผู้รับโอนผลประโยชน์</a>
                                <a class="nav-link" data-toggle="pill" href="#v-pills-doc" role="tab" aria-selected="false">เอกสารประกอบ</a>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-personal-info" role="tabpanel">
                                    <div class="form-row">
                                        <div class="form-group col-2">
                                            <label>สังกัดจังหวัด</label>
                                            <input type="text" class="form-control" value="{{ $member->receipt_province }}" readonly/>
                                        </div>
                                        <div class="form-group col-2">
                                            <label>คำนำหน้า</label>
                                            <input type="text" class="form-control" value="{{ $member->title == 'อื่นๆ'? $member->other_title: $member->title}}" readonly/>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>ชื่อ</label>
                                            <input type="text" class="form-control" value="{{ $member->firstname }}" readonly/>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>นามสกุล</label>
                                            <input type="text" class="form-control" value="{{ $member->lastname }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-4">
                                            <label>บัตรประจำตัวประชาชนเลขที่</label>
                                            <input type="text" class="form-control" value="{{ $member->id_card_no }}" readonly/>
                                        </div>
                                        <div class="form-group col-2">
                                            <label>วันหมดอายุ</label>
                                            <input type="text" class="form-control" value="{{ $member->exp_date }}" readonly/>
                                        </div>
                                        <div class="form-group col-2">
                                            <label>อายุ</label>
                                            <input type="text" class="form-control" value="{{ $member->age }}" readonly/>
                                        </div>
                                        <div class="form-group col-2">
                                            <label>สัญชาติ</label>
                                            <input type="text" class="form-control" value="{{ $member->nationality }}" readonly/>
                                        </div>
                                        <div class="form-group col-2">
                                            <label>โทรศัพท์</label>
                                            <input type="text" class="form-control" value="{{ $member->mobile }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-5">
                                            <label>บัตรข้าราชการ/บัตรพนักงานรัฐวิสาหกิจ</label>
                                            <input type="text" class="form-control" value="{{ $member->emp_card_no }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-3">
                                            <label>เป็นบุคคลล้มละลายหรือไม่</label>
                                            <input type="text" class="form-control" value="{{ $member->is_bankrupt }}" readonly/>
                                        </div>
                                        <div class="form-group col-2">
                                            <label>คนไร้ความสามารถ</label>
                                            <input type="text" class="form-control" value="{{ $member->is_incompetent_person }}" readonly/>
                                        </div>
                                        <div class="form-group col-2">
                                            <label>ทุพพลภาพถาวร</label>
                                            <input type="text" class="form-control" value="{{ $member->is_permanent_disability }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>คนเสมือนไร้ความสามารถ</label>
                                            <input type="text" class="form-control" value="{{ $member->is_quasi_incompetent_person }}" readonly/>
                                        </div>
                                        <div class="form-group col-2">
                                            <label>สถานภาพสมรส</label>
                                            <input type="text" class="form-control" value="{{ $member->marital_status }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-3">
                                            <label>จำนวนบุตร</label>
                                            <input type="text" class="form-control" value="{{ $member->number_of_children }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>จำนวนบุตรที่กำลังศึกษาอยู่</label>
                                            <input type="text" class="form-control" value="{{ $member->number_of_children_study }}" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-spouse" role="tabpanel">
                                    <div class="form-row">
                                        <div class="form-group col-2">
                                            <label>คำนำหน้า</label>
                                            <input type="text" class="form-control" value="{{ $member->spouse_title == 'อื่นๆ'? $member->other_spouse_title: $member->spouse_title}}" readonly/>
                                        </div>
                                        <div class="form-group col-5">
                                            <label>ชื่อ</label>
                                            <input type="text" class="form-control" value="{{ $member->spouse_firstname }}" readonly/>
                                        </div>
                                        <div class="form-group col-5">
                                            <label>นามสกุล</label>
                                            <input type="text" class="form-control" value="{{ $member->spouse_lastname }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-4">
                                            <label>บัตรประจำตัวประชาชนเลขที่</label>
                                            <input type="text" class="form-control" value="{{ $member->spouse_id_card_no }}" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-addr" role="tabpanel">
                                    <div class="form-row">
                                        <div class="form-group col-2">
                                            <label>บ้านเลขที่</label>
                                            <input type="text" class="form-control" value="{{ $member->house_no }}" readonly/>
                                        </div>
                                        <div class="form-group col-2">
                                            <label>หมู่ที่</label>
                                            <input type="text" class="form-control" value="{{ $member->moo }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>ตรอก/ซอย</label>
                                            <input type="text" class="form-control" value="{{ $member->soi }}" readonly/>
                                        </div>
                                        <div class="form-group col-5">
                                            <label>ถนน</label>
                                            <input type="text" class="form-control" value="{{ $member->street }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-3">
                                            <label>ตำบล/แขวง</label>
                                            <input type="text" class="form-control" value="{{ $member->sub_district }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>อำเภอ/เขต</label>
                                            <input type="text" class="form-control" value="{{ $member->district }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>จังหวัด</label>
                                            <input type="text" class="form-control" value="{{ $member->province }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>รหัสไปรษณีย์</label>
                                            <input type="text" class="form-control" value="{{ $member->post_code }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-4">
                                            <label>โทรศัพท์</label>
                                            <input type="text" class="form-control" value="{{ $member->tel }}" readonly/>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>โทรสาร</label>
                                            <input type="text" class="form-control" value="{{ $member->fax }}" readonly/>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>อีเมล</label>
                                            <input type="text" class="form-control" value="{{ $member->mail }}" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-ship" role="tabpanel">
                                    <div class="form-row">
                                        <div class="form-group col-2">
                                            <label>บ้านเลขที่</label>
                                            <input type="text" class="form-control" value="{{ $member->ship_house_no }}" readonly/>
                                        </div>
                                        <div class="form-group col-2">
                                            <label>หมู่ที่</label>
                                            <input type="text" class="form-control" value="{{ $member->ship_moo }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>ตรอก/ซอย</label>
                                            <input type="text" class="form-control" value="{{ $member->ship_soi }}" readonly/>
                                        </div>
                                        <div class="form-group col-5">
                                            <label>ถนน</label>
                                            <input type="text" class="form-control" value="{{ $member->ship_street }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-3">
                                            <label>ตำบล/แขวง</label>
                                            <input type="text" class="form-control" value="{{ $member->ship_sub_district }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>อำเภอ/เขต</label>
                                            <input type="text" class="form-control" value="{{ $member->ship_district }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>จังหวัด</label>
                                            <input type="text" class="form-control" value="{{ $member->ship_province }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>รหัสไปรษณีย์</label>
                                            <input type="text" class="form-control" value="{{ $member->ship_postcode }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-3">
                                            <label>โทรศัพท์</label>
                                            <input type="text" class="form-control" value="{{ $member->ship_tel }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>อีเมล</label>
                                            <input type="text" class="form-control" value="{{ $member->ship_mail }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>ID Line</label>
                                            <input type="text" class="form-control" value="{{ $member->ship_line }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>Facebook</label>
                                            <input type="text" class="form-control" value="{{ $member->ship_fb }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-4">
                                            <label>ที่อยู่อาศัยปัจจุบัน</label>
                                            <input type="text" class="form-control" value="{{ $member->house_type }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>ผ่อนชำระ/ค่าเช่า (ต่อเดือน)</label>
                                            <input type="text" class="form-control" value="{{ $member->cost_per_month }}" readonly/>
                                        </div>
                                        <div class="form-group col-2">
                                            <label>อาศัยอยู่เป็นเวลา (ปี)</label>
                                            <input type="text" class="form-control" value="{{ $member->house_year }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-4">
                                            <label>ระดับการศึกษาสูงสุด</label>
                                            <input type="text" class="form-control" value="{{ $member->education_level == 'อื่นๆ'? $member->other_education_level: $member->education_level }}" readonly/>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>สาขาอาชีพ</label>
                                            <input type="text" class="form-control" value="{{ $member->career == 'อื่นๆ'? $member->other_career: $member->career }}" readonly/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<pre>{{ print_r($member) }}</pre>
@endsection
