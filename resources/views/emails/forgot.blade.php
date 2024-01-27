@component('mail::message')
Salam {{ $user->name }}

Bu hər birimizin başına gələ bilər.

@component('mail::button', ['url' => url('reset/'.$user->remember_token)])
Şifrənizi Yeniləyin
@endcomponent

<p>Şifrənizi bərpa etməkdə hər hansı çətinlik yaşandığı halda bizimlə əlaqə saxalyın.</p>

Təşəkkürlər, </br>
{{ config('app.name') }}
@endcomponent
