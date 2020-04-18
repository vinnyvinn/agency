@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
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
<h4>Powering our Customers to be Leaders in Their Markets</h4>

<p>This email is confidential and intended only for the use of the above named addressee. If you have received this email in error, please delete it immediately and notify us by email or telephone.</p>
@endcomponent
