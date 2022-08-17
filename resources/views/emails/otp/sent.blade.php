@component('mail::message')
# Your OTP is

<h1><strong>{{$otp}}</strong></h1>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
ROM Fashion
@endcomponent
