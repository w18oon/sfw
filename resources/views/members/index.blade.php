@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h6 class="mt-2">{{ __('ข้อมูลสมาชิก') }}</h6>
                        <form action="{{ url('member') }}" style="display: inline;" method="GET">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="q" class="form-control float-right" placeholder="บัตรประจำตัวประชาชนเลขที่" value="{{ $q }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
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
                                <td>{{ $member->updated_by }}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-primary" href="{{ url("receipt/$member->id") }}">ใบเสร็จรับเงิน</a>
                                    <a class="btn btn-sm btn-outline-primary" href="{{ url("contract/$member->id") }}">ใบสมัครสมาชิก/สัญญา</a>
                                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('member.edit', $member->id) }}">แก้ไขข้อมุล</a>
                                    <form id="{{$member->id}}" action="{{ route('member.delete', $member->id) }}" style="display: inline;" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                            class="btn btn-sm btn-outline-danger" 
                                            onclick="swal('คุณต้องการลบข้อมูลรายการนี้หรือไม่', {
                                                buttons: {
                                                    cancel: 'ยกเลิก',
                                                    confirm: 'ยืนยัน'
                                                }
                                            }).then(value => {
                                                if (value) {
                                                    document.getElementById(`{{$member->id}}`).submit();
                                                }
                                            });">ลบข้อมุล</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $members->appends(['q' => $q])->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
