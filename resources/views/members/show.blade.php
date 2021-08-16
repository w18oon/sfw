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
                                <a class="nav-link" data-toggle="pill" href="#v-pills-docs" role="tab" aria-selected="false">เอกสารประกอบ</a>
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
                                <div class="tab-pane fade" id="v-pills-income" role="tabpanel">
                                    <div class="form-row">
                                        <div class="form-group col-2">
                                            <label>รายได้ประจำ</label>
                                            <input type="text" class="form-control" value="{{ $member->income_type }}" readonly/>
                                        </div>
                                        <div class="form-group col-2">
                                            <label>จำนวน (บาท/เดือน)</label>
                                            <input type="text" class="form-control" value="{{ $member->income_amount }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-3">
                                            <label>รายได้อื่นๆ</label>
                                            <input type="text" class="form-control" value="{{ $member->other_income_type == 'อื่นๆ' ? $member->other_income :$member->other_income_type }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>จำนวน (บาท/เดือน)</label>
                                            <input type="text" class="form-control" value="{{ $member->other_income_amount }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>แหล่งที่มา</label>
                                            <input type="text" class="form-control" value="{{ $member->source_other_income }}" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-debt" role="tabpanel">
                                    @foreach (['หนี้สินในระบบแบบถูกกฏหมาย', 'หนี้สินนอกระบบแบบถูกกฏหมาย', 'หนี้สินนอกระบบแบบผิดกฏหมาย', 'หนี้สินแบบสหกรณ์'] as $debt_type)
                                        <h5 class="mb-3">{{ $loop->iteration . "." . $debt_type }}</h5>
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">เป็นหนี้คงเหลือ</label>
                                            <div class="col-4">
                                                <input type="number" class="form-control" value="{{ $member->{'debt_type_' . $loop->iteration} }}" readonly/>
                                            </div>
                                            <label class="col-2 col-form-label">บาท</label>
                                        </div>
                                        @foreach ($member->debts as $debt)
                                            @if ($debt->type == $loop->parent->iteration) 
                                            <fieldset>
                                                <div class="form-row">
                                                    <div class="form-group col-6">
                                                        <strong>{{ __('รายการที่ ') . $loop->parent->iteration . __('.') . $loop->iteration }}</strong>
                                                    </div>
                                                </div>
                                                @if ($debt->type == 3)
                                                <div class="form-row">
                                                    <div class="form-group col-2">
                                                        <label>กู้ยืมเงินจาก</label>
                                                        <input type="text" class="form-control" value="{{ $debt->bank_name }}" readonly/>
                                                    </div>
                                                    <div class="form-group col-2">
                                                        <label>เบอร์โทรศัพท์</label>
                                                        <input type="text" class="form-control" value="{{ $debt->contact }}" readonly/>
                                                    </div>
                                                    <div class="form-group col-2">
                                                        <label>วันที่ลงสัญญา</label>
                                                        <input type="text" class="form-control" value="{{ $debt->contract_date }}" readonly/>
                                                    </div>
                                                    <div class="form-group col-2">
                                                        <label>จำนวนเงินที่กู้</label>
                                                        <input type="text" class="form-control" value="{{ $debt->total_amount }}" readonly/>
                                                    </div>
                                                    <div class="form-group col-2">
                                                        <label>ดอกเบี้ยร้อยละ</label>
                                                        <input type="text" class="form-control" value="{{ $debt->interest }}" readonly/>
                                                    </div>
                                                    <div class="form-group col-2">
                                                        <label>จำนวนหนี้คงเหลือ</label>
                                                        <input type="text" class="form-control" value="{{ $debt->remaining_amount }}" readonly/>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-2">
                                                        <label>สถานะหนี้</label>
                                                        <input type="text" class="form-control" value="{{ $debt->status }}" readonly/>
                                                    </div>
                                                    <div class="form-group col-2">
                                                        <label>อื่นๆ (โปรดระบุ)</label>
                                                        <input type="text" class="form-control" value="{{ $debt->other_status }}" readonly/>
                                                    </div>
                                                    <div class="form-group col-2">
                                                        <label>วันที่ถูกฟ้องต่อศาล</label>
                                                        <input type="text" class="form-control" value="{{ $debt->date_1 }}" readonly/>
                                                    </div>
                                                    <div class="form-group col-2">
                                                        <label>วันที่ถูกบังคับคดี</label>
                                                        <input type="text" class="form-control" value="{{ $debt->date_2 }}" readonly/>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="form-row">
                                                    <div class="form-group col-3"> 
                                                        <label>{{ $debt->type == 4 ? 'สหกรณ์': 'สถาบันการเงิน' }}</label>
                                                        <input type="text" class="form-control" value="{{ $debt->bank_name }}" readonly/>
                                                    </div>
                                                    <div class="form-group col-3">
                                                        <label>สาขา</label>
                                                        <input type="text" class="form-control" value="{{ $debt->bank_branch }}" readonly/>
                                                    </div>
                                                    <div class="form-group col-2">
                                                        <label>เบอร์โทรศัพท์</label>
                                                        <input type="text" class="form-control" value="{{ $debt->contact }}" readonly/>
                                                    </div>
                                                    <div class="form-group col-2">
                                                        <label>เลขที่สัญญา</label>
                                                        <input type="text" class="form-control" value="{{ $debt->contract_no }}" readonly/>
                                                    </div>
                                                    <div class="form-group col-2">
                                                        <label>วันที่ลงสัญญา</label>
                                                        <input type="text" class="form-control" value="{{ $debt->contract_date }}" readonly/>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-2">
                                                        <label>จำนวนเงินที่กู้</label>
                                                        <input type="text" class="form-control" value="{{ $debt->total_amount }}" readonly/>
                                                    </div>
                                                    <div class="form-group col-2">
                                                        <label>จำนวนหนี้คงเหลือ</label>
                                                        <input type="text" class="form-control" value="{{ $debt->remaining_amount }}" readonly/>
                                                    </div>
                                                    <div class="form-group col-2">
                                                        <label>สถานะหนี้</label>
                                                        <input type="text" class="form-control" value="{{ $debt->status }}" readonly/>
                                                    </div>
                                                    <div class="form-group col-2">
                                                        <label>อื่นๆ (โปรดระบุ)</label>
                                                        <input type="text" class="form-control" value="{{ $debt->other_status }}" readonly/>
                                                    </div>
                                                    <div class="form-group col-2">
                                                        <label>วันที่ถูกฟ้องต่อศาล</label>
                                                        <input type="text" class="form-control" value="{{ $debt->date_1 }}" readonly/>
                                                    </div>
                                                    <div class="form-group col-2">
                                                        <label>วันที่ถูกบังคับคดี</label>
                                                        <input type="text" class="form-control" value="{{ $debt->date_2 }}" readonly/>
                                                    </div>
                                                </div>
                                                @endif
                                            </fieldset>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                                <div class="tab-pane fade" id="v-pills-work" role="tabpanel">
                                    <div class="form-row">
                                        <div class="form-group col-4">
                                            <label>ชื่อสถานที่ทำงาน</label>
                                            <input type="text" class="form-control" value="{{ $member->workplace }}" readonly/>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>อาคาร</label>
                                            <input type="text" class="form-control" value="{{ $member->building }}" readonly/>
                                        </div>
                                        <div class="form-group col-1">
                                            <label>ชั้น</label>
                                            <input type="text" class="form-control" value="{{ $member->floor }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>แผนก/ฝ่าย</label>
                                            <input type="text" class="form-control" value="{{ $member->department }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-2">
                                            <label>เลขที่</label>
                                            <input type="text" class="form-control" value="{{ $member->workplace_no }}" readonly/>
                                        </div>
                                        <div class="form-group col-2">
                                            <label>หมู่ที่</label>
                                            <input type="text" class="form-control" value="{{ $member->workplace_moo }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>ตรอก/ซอย</label>
                                            <input type="text" class="form-control" value="{{ $member->workplace_soi }}" readonly/>
                                        </div>
                                        <div class="form-group col-5">
                                            <label>ถนน</label>
                                            <input type="text" class="form-control" value="{{ $member->workplace_street }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-2">
                                            <label>จังหวัด</label>
                                            <input type="text" class="form-control" value="{{ $member->workplace_province }}" readonly/>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>อำเภอ/เขต</label>
                                            <input type="text" class="form-control" value="{{ $member->workplace_district }}" readonly/>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>ตำบล/แขวง</label>
                                            <input type="text" class="form-control" value="{{ $member->workplace_sub_district }}" readonly/>
                                        </div>
                                        <div class="form-group col-2">
                                            <label>รหัสไปรษณีย์</label>
                                            <input type="text" class="form-control" value="{{ $member->workplace_postcode }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-3">
                                            <label>โทรศัพท์</label>
                                            <input type="text" class="form-control" value="{{ $member->workplace_tel }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>โทรสาร</label>
                                            <input type="text" class="form-control" value="{{ $member->workplace_fax }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>อายุงานปัจจุบัน (ปี/เดือน)</label>
                                            <input type="text" class="form-control" value="{{ $member->work_exp }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>ชื่อตำแหน่งงาน</label>
                                            <input type="text" class="form-control" value="{{ $member->job_position }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-8">
                                            <label>กรณีที่ผู้มีรายได้ประจำ อายุงานไม่ถึง 6 เดือน โปรดระบุชื่อสถานที่ทำงานเดิม</label>
                                            <input type="text" class="form-control" value="{{ $member->old_workplace }}" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-benef" role="tabpanel">
                                    <div class="form-row">
                                        <div class="form-group col-2">
                                            <label>คำนำหน้า</label>
                                            <input type="text" class="form-control" value="{{ $member->benef_title }}" readonly/>
                                        </div>
                                        <div class="form-group col-2">
                                            <label>อื่นๆ (โปรดระบุ)</label>
                                            <input type="text" class="form-control" value="{{ $member->benef_other_title }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>ชื่อ</label>
                                            <input type="text" class="form-control" value="{{ $member->benef_firstname }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>นามสกุล</label>
                                            <input type="text" class="form-control" value="{{ $member->benef_lastname }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-3">
                                            <label>บัตรประจำตัวประชาชนเลขที่</label>
                                            <input type="text" class="form-control" value="{{ $member->benef_id_card_no }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>มีความสัมพันธ์เป็น</label>
                                            <input type="text" class="form-control" value="{{ $member->benef_relationship }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-2">
                                            <label>เลขที่</label>
                                            <input type="text" class="form-control" value="{{ $member->benef_house_no }}" readonly/>
                                        </div>
                                        <div class="form-group col-2">
                                            <label>หมู่ที่</label>
                                            <input type="text" class="form-control" value="{{ $member->benef_moo }}" readonly/>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>ตรอก/ซอย</label>
                                            <input type="text" class="form-control" value="{{ $member->benef_soi }}" readonly/>
                                        </div>
                                        <div class="form-group col-5">
                                            <label>ถนน</label>
                                            <input type="text" class="form-control" value="{{ $member->benef_street }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-2">
                                            <label>จังหวัด</label>
                                            <input type="text" class="form-control" value="{{ $member->benef_province }}" readonly/>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>อำเภอ/เขต</label>
                                            <input type="text" class="form-control" value="{{ $member->benef_district }}" readonly/>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>ตำบล/แขวง</label>
                                            <input type="text" class="form-control" value="{{ $member->benef_sub_district }}" readonly/>
                                        </div>
                                        <div class="form-group col-2">
                                            <label>รหัสไปรษณีย์</label>
                                            <input type="text" class="form-control" value="{{ $member->benef_postcode }}" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-docs" role="tabpanel">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">รายการ</th>
                                                <th scope="col">ไฟล์</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($member->documents as $doc)
                                            <tr>
                                                <td scope="row">{{ $loop->iteration }}</td>
                                                <td>
                                                    <input type="text" class="form-control" value={{ $doc->desc }} readonly/>
                                                </td>
                                                <td>
                                                    @if ($doc->name != '')
                                                    <a href="{{ url("/storage/uploads/$doc->name") }}" target="_blank">เปิดไฟล์</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
