<h1>{{ __('Здравствуйте') }}, {{ $user->name }}</h1>
<p>
    {{ __('Для подтверждения аккаунта, пройдите по ссылке') }}:
    <a href="{{ route('email.verify', [$user->emailVerifyToken->value]) }}"></a>
</p>
