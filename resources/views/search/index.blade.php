@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ค้นหาข้อมูลสมาชิก</div>
                <div class="card-body">
                    <form action="{{ url('search') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="q" class="form-control" placeholder="เลขที่บัตรประจำตัวประชาชน">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" id="button-addon2">ค้นหา</button>
                            </div>
                        </div>
                    </form>
                    @if($q && empty($member))
                    <div class="alert alert-danger" role="alert">ไม่พบข้อมูลสมาชิกของเลขที่บัตรประจำตัวประชาชน <strong>{{ $q }}</strong></div>
                    @endif
                    @isset($member->id_card_no)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">เลขที่สมาชิก</th>
                                <th scope="col">ชื่อ</th>
                                <th scope="col">นามสกุล</th>
                                <th scope="col">เลขที่บัตรประจำตัวประชาชน</th>
                                <th scope="col">ใบเสร็จรับเงิน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $member->no }}</td>
                                <td>{{ $member->firstname}}</td>
                                <td>{{ $member->lastname}}</td>
                                <td>{{ $member->id_card_no}}</td>
                                <td><a class="btn btn-primary" href="{{ url("receipt/$member->id") }}">พิมพ์ใบเสร็จรับเงิน</a></td>
                            </tr>
                        </tbody>
                      </table>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
