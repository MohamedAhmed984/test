@component('mail::message')
# Introduction

Blood bank reset password
@component('mail::button', ['url' => ''])
Button Text
@endcomponent

<p>Your code of reset password is : {{ $code }} </p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
