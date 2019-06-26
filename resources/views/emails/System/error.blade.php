@component('mail::message')
# {{ $data['subject'] }}

{{$data['body']}}

Thanks,<br>
Agency ~ {{ config('app.name') }}
@endcomponent
