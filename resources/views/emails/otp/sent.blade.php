@component('mail::message')
# Your OTP is

{{$otp}}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
ROM Fashion
@endcomponent
