@component('mail::message')
# Introduction

# Bienvenue {{ $user->name }}

Merci de vous être inscrit(e) avec l'adresse {{ $user->email }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
