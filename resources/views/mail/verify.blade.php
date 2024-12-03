<h1>Здравствуйте, {{ $user->name }}</h1>
<p>
    Для подтверждения аккаунта, пройдите по ссылке:
    <a href="{{ route('email.verify', [$user->emailVerifyToken->value]) }}"></a>
</p>
