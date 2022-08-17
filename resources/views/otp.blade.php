@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
                <div class="bg-white">
                    <h1>Hi {{$user['name']}}!</h1>
                    <h5>This is your OTP {{$user['otp']}}</h5>
                </div>
                
            </div>
            <div class="col-md-2">

            </div>
        </div>
    </div>
@endsection