@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <form action="{{ url('report') }}" method="GET">
                @csrf
                <h4 class="mb-3">รายงาน</h4>
                <div class="form-row">
                    <div class="form-group col-2">
                        <label>ภูมิภาค</label>
                        <select name="q_region" class="custom-select">
                            <option value="all">ทั้งหมด</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region }}" {{ $region == $q_region? 'selected': ''}}>{{ $region }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-2">
                        <label>สังกัดจังหวัด</label>
                        <select name="q_province" class="custom-select">
                            <option value="all">ทั้งหมด</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->name_th }}" {{ $province->name_th == $q_province? 'selected': ''}}>{{ $province->name_th }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-2">
                        <label>วันที่สมัครสมาชิก (จาก)</label>
                        <input type="text" name="q_date_from" class="form-control datepicker" value="{{ $q_date_from }}">
                    </div>
                    <div class="form-group col-2">
                        <label>วันที่สมัครสมาชิก (ถึง)</label>
                        <input type="text" name="q_date_to" class="form-control datepicker" value="{{ $q_date_to }}">
                    </div>
                    <div class="form-group col-2">
                        <label>อายุ (จาก)</label>
                        <input type="number" name="q_age_from" class="form-control" value="{{ $q_age_from }}">
                    </div>
                    <div class="form-group col-2">
                        <label>อายุ (ถึง)</label>
                        <input type="number" name="q_age_to" class="form-control" value="{{ $q_age_to }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-4">
                        <label>ภาระหนี้กับสถาบันการเงิน/บริษัท/หนี้นอกระบบ</label>
                        <select name="q_npl" class="custom-select">
                            <option value="all">ทั้งหมด</option>
                            @foreach ($npls as $npl)
                                <option value="{{ $loop->iteration }}" {{ $loop->iteration == $q_npl? 'selected': ''}}>{{ $npl }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <label>สถาบันการเงิน</label>
                        <select name="q_bank" class="custom-select">
                            <option value="all">ทั้งหมด</option>
                            @foreach ($banks as $bank)
                                <option value="{{ $bank }}" {{ $bank == $q_bank? 'selected': ''}}>{{ $bank }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <label>รูปแบบรายงาน</label>
                        <select name="report_type" class="custom-select">
                            <option value="summary" {{ $report_type == 'summary'? 'selected': ''}}>สรุป</option>
                            <option value="detail" {{ $report_type == 'detail'? 'selected': ''}}>รายละเอียด</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-3"><i class="fas fa-search"></i> ค้นหา</button>
            </form>
            @if ($report_type != '')
            <div class="card">
                <div class="card-body p-0">
                    <table class="table">
                        @if ($report_type == 'summary')
                            <thead>
                                <tr>
                                    <th scope="col">ภาค</th>
                                    <th scope="col">จังหวัด</th>
                                    <th scope="col">หนี้</th>
                                    <th scope="col">จำนวนสมากชิก</th>
                                    <th scope="col">ยอดรวม</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr>
                                        <td>{{ $item->region_name_th }}</td>
                                        <td>{{ $item->name_th }}</td>
                                        <td>{{ $npls[$item->type - 1] }}</td>
                                        <td>{{ $item->total_member }}</td>
                                        <td>{{ number_format($item->sum_remaining_amount, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">ไม่พบข้อมูล</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        @else
                            <thead>
                                <tr>
                                    <th scope="col">เลขที่สมาชิก</th>
                                    <th scope="col">เลขที่บัตรประจำตัวประชาชน</th>
                                    <th scope="col">ชื่อ</th>
                                    <th scope="col">นามสกุล</th>
                                    <th scope="col">เบอร์โทรศัพท์</th>
                                    <th scope="col">ภูมิภาค</th>
                                    <th scope="col">สังกัดจังหวัด</th>
                                    <th scope="col">วันที่สมัครสมาชิก</th>
                                    <th scope="col">อายุ</th>
                                    <th scope="col">หนี้</th>
                                    <th scope="col">สถาบันการเงิน</th>
                                    <th scope="col">จำนวนหนี้คงเหลือ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr>
                                        {{-- 'members.no', 'members.id_card_no', 'members.firstname', 'members.lastname', 'members.mobile', 'members.receipt_province', 'members.created_at', 'provinces.region_name_th', 'members.age', 'debts.type', 'debts.remaining_amount' --}}
                                        <td>{{ $item->no }}</td>
                                        <td>{{ $item->id_card_no }}</td>
                                        <td>{{ $item->firstname }}</td>
                                        <td>{{ $item->lastname }}</td>
                                        <td>{{ $item->mobile }}</td>
                                        <td>{{ $item->region_name_th }}</td>
                                        <td>{{ $item->receipt_province }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->age }}</td>
                                        <td>{{ $npls[$item->type - 1] }}</td>
                                        <td>{{ $item->bank_name }}</td>
                                        <td>{{ number_format($item->remaining_amount, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">ไม่พบข้อมูล</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        @endif
                    </table>
                    {{-- {!! $members->appends([
                        'no' => $no, 
                        'id_card_no' => $id_card_no,
                        'receipt_province' => $receipt_province,
                        'date_from' => $date_from,
                        'date_to' => $date_to,
                        ])->render() !!} --}}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
