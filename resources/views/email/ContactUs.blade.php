@component('mail::message')
# New Message From {{$request['name']}}

Sender Name: {{$request['name']}}
<br>
Sender Email: <a href="mailto:{{$request['email']}}" target="_top">{{$request['email']}}</a>
<br>
Sender Phone No: <a href="tel:{{$request['phone']}}" target="_top">{{$request['phone']}}</a>
<br>
Message: {{$request['message']}}

@endcomponent