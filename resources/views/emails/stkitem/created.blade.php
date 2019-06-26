@component('mail::message')
# New Item
New item has been added in Sage. Kindly log into Sage and map to it respective account.

#Item Details
Item Name : {{ $data['name'] }} <br>
Database/Company : {{ $data['company'] }} <br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
