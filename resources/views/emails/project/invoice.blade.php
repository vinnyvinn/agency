    @component('mail::message')
    # Client Quotation Review

    {{ ucfirst($data['message']) }}

    Thanks,<br>
    {{ config('app.name') }}
    @endcomponent
