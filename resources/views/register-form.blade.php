@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>สมัครสมาชิก</h3>
                </div>
                <div class="card-body" id="register-form" data-postcodes="{{ json_encode($postcodes) }}" data-member=""></div>
            </div>
        </div>
    </div>
</div>
@endsection
