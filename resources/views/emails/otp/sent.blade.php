@component('mail::message')
# Welcome To ROM Fashion

<h4 style="text-align:center">Your OTP is</h4>
<h1 style="font-size:38px; margin-top:50px; text-align:center"><strong>{{$otp}}</strong></h1>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
ROM Fashion
@endcomponent
