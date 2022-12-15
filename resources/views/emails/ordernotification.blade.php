@component('mail::message')
# Introduction

Dear Customer {{$email}},

@if($status=='Success')
    Transaction #{{$transactionId}} success.
    Thank you for purchasing our product. Check order status in your profile
@elseif($status=='Expired')
    Transaction #{{$transactionId}} already expired.
    Please pay the product according to the specified time.
@else
    Transaction #{{$transactionId}} has been Canceled.
    Something's wrong, please try again later.
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
