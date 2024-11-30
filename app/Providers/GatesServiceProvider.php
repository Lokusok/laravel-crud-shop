<?php

namespace App\Providers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class GatesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('see-auth', function () {
            $result = Session::get('can_see');

            return $result;
        });

        Gate::define('admin', function (User $user) {
            return $user->isAdmin;
        });

        Gate::define('delete-message', function (User $user, Message $message) {
            return $user->id === $message->user_id;
        });
    }
}
