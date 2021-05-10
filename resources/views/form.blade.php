@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">ข้อมูลสมาชิก</div>
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="title">คำนำหน้า</label>
                                <input type="text" class="form-control" id="title">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="firstname">ชื่อ</label>
                                <input type="text" class="form-control" id="firstname">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="lastname">นามสกุล</label>
                                <input type="text" class="form-control" id="lastname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">ที่อยู่</label>
                            <input type="text" class="form-control" id="address" placeholder="บ้านเลขที่ หมู่ที่ ถนน/ตรอก/ซอย">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="sub-district">ตำบล</label>
                                <input type="text" class="form-control" id="sub-district">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="district">อำเภอ</label>
                                <input type="text" class="form-control" id="district">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="province">จังหวัด</label>
                                <input type="text" class="form-control" id="province">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="post-code">รหัสไปรษณีย์</label>
                                <input type="text" class="form-control" id="post-code">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="id-card-no">เลขประจำตัวประชาชน</label>
                                <input type="text" class="form-control" id="id-card-no">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="mobile-no">หมายเลขโทรศัพท์</label>
                                <input type="text" class="form-control" id="mobile-no">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="career">อาชีพ</label>
                                <input type="text" class="form-control" id="career">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="debt-in-credit-bureau">มูลหนี้ในระบบที่ปรากฏในเครดิตบูโร</label>
                                <input type="text" class="form-control" id="debt-in-credit-bureau">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="debt-out-credit-bureau">มูลหนี้ในระบบที่ไม่ปรากฏในเครดิตบูโร</label>
                                <input type="text" class="form-control" id="debt-out-credit-bureau">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="informal-debt">มูลหนี้นอกระบบ</label>
                                <input type="text" class="form-control" id="informal-debt">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="total-debt">รวมทั้งสิ้น (มูลหนี้)</label>
                                <input type="text" class="form-control" id="total-debt" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="saving-per-month">จำนวนเงินฝาก/เดือน</label>
                                <input type="text" class="form-control" id="saving-per-month">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="remarks">หมายเหตุ</label>
                            <input type="text" class="form-control" id="remarks">
                        </div>
                        <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
