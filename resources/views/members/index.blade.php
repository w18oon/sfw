@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <p class="h2">ข้อมูลสมาชิก</p>
            <form action="{{ url('member') }}" method="GET">
                @csrf
                <div class="form-row">
                    <div class="form-group col-2">
                        <label>เลขที่สมาชิก</label>
                        <input type="text" name="no" class="form-control" value="{{$no}}">
                    </div>
                    <div class="form-group col-2">
                        <label>เลขที่บัตรประจำตัวประชาชน</label>
                        <input type="text" name="id_card_no" class="form-control" value="{{$id_card_no}}">
                    </div>
                    <div class="form-group col-2">
                        <label>สังกัดจังหวัด</label>
                        <select name="receipt_province" class="form-control">
                            <option value="">เลือก</option>
                            @foreach ($provinces as $province)
                                <option value="{{$province->name_th}}" @if($province->name_th == $receipt_province) selected @endif>{{$province->name_th}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-2">
                        <label>วันที่สมัครสมาชิก (จาก)</label>
                        <input type="text" name="date_from" class="form-control datepicker" value="{{$date_from}}">
                    </div>
                    <div class="form-group col-2">
                        <label>วันที่สมัครสมาชิก (ถึง)</label>
                        <input type="text" name="date_to" class="form-control datepicker" value="{{$date_to}}">
                    </div>
                    <div class="form-group col-2">
                        <label>สถานะ</label>
                        <select name="q_status" class="form-control">
                            <option value="">เลือก</option>
                            @foreach ($status_list as $status)
                                <option value="{{ $status }}" @if($status == $q_status) selected @endif>{{$status}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-3"><i class="fas fa-search"></i> ค้นหา</button>
            </form>
            <div class="card">
                <div class="card-body p-0">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible mt-3 fade show" role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">เลขที่สมาชิก</th>
                                <th scope="col">ชื่อ</th>
                                <th scope="col">นามสกุล</th>
                                <th scope="col">เลขที่บัตรประจำตัวประชาชน</th>
                                <th scope="col">สถานะ</th>
                                <th scope="col">แก้ไขข้อมูลล่าสุดโดย</th>
                                <th scope="col">ดำเนินการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                            <tr>
                                <td>{{ $member->no }}</td>
                                <td>{{ $member->firstname }}</td>
                                <td>{{ $member->lastname }}</td>
                                <td>{{ $member->id_card_no }}</td>
                                <td>
                                    <select class="custom-select" onchange="axios.put('/api/upd-member-status/{{ $member->id }}' , { status: this.value, updated_by: '{{ $updated_by }}' }).then(response => { console.log(response); swal('บันทึกข้อมูลสำเร็จ', 'แก้ไขข้อมูลสถานะของผู้สมัครสำเร็จ', 'success'); }).catch(error => { console.log(error); });">
                                        @foreach ($status_list as $status)
                                            <option value="{{ $status }}" {{ $status == $member->status? 'selected': '' }}>{{$status}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>{{ $member->updated_by }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ดูข้อมูล</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('member.show', $member->id) }}">ข้อมูลสมัคร</a>
                                            <a class="dropdown-item" href="{{ url("receipt/$member->id") }}" target="_blank">ใบเสร็จรับเงิน</a>
                                            <a class="dropdown-item" href="{{ url("contract/$member->id") }}" target="_blank">ใบสมัครสมาชิก/สัญญา</a>
                                            <a class="dropdown-item" href="{{ url("debt/$member->id") }}" target="_blank">ใบแสดงรายการหนี้สิน</a>
                                        </div>
                                    </div>
                                    <a class="btn btn-outline-secondary" href="{{ route('member.edit', $member->id) }}">แก้ไขข้อมูล</a>
                                    <form id="{{$member->id}}" action="{{ route('member.delete', $member->id) }}" style="display: inline;" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                            class="btn btn-outline-danger" 
                                            onclick="swal('คุณต้องการลบข้อมูลรายการนี้หรือไม่', {
                                                buttons: {
                                                    cancel: 'ยกเลิก',
                                                    confirm: 'ยืนยัน'
                                                }
                                            }).then(value => {
                                                if (value) {
                                                    document.getElementById(`{{$member->id}}`).submit();
                                                }
                                            });">ลบข้อมูล</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $members->appends([
                        'no' => $no, 
                        'id_card_no' => $id_card_no,
                        'receipt_province' => $receipt_province,
                        'date_from' => $date_from,
                        'date_to' => $date_to,
                        ])->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
