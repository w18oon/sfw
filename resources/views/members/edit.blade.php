@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>แก้ไขข้อมูลสมัครสมาชิก</h3>
                </div>
                {{-- <div class="card-body" id="member-form" data="{{ json_encode($props) }}"></div> --}}
                <div class="card-body" 
                    id="register-form" 
                    data-postcodes="{{ json_encode($postcodes) }}" 
                    data-member="{{ json_encode($member) }}"
                    data-updated-by="{{ $updated_by }}"></div>
            </div>
        </div>
    </div>
</div>
@endsection
