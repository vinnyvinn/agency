@component('mail::message')

    {!! $data['message']  !!}

@component('mail::button', ['url' => url($data['url'])])
View Quotation
@endcomponent
@component('mail::button', ['url' => url($data['download'])])
Download Quotation
@endcomponent



Kind Regards,

{{ ucwords($data['user']) }} | Operations <br>
6th Floor, Cannon Towers II, Moi Avenue <br>
P. O. Box 1922 - 80100, Mombasa, Kenya <br>
Phone: +254 41 2229784/6/2224822 <br>
agency@esl-eastafrica.com <br>
http://www.esl-eastafrica.com <br>
<img src="{{ asset('/images/logo.png') }}" alt="">
<br>
<h4>Powering our Customers to be Leaders in their Markets</h4>

<p>This e­mail is confidential and intended only for the use of the above named addressee. If you have received this e­mail in error, please delete it immediately and notify us by e­mail or telephone.</p>


@endcomponent
