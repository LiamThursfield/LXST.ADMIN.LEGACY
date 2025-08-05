<?php

namespace App\Notifications\Auth;

use App\Interfaces\RoleInterface;
use App\Providers\RouteServiceProvider;

class ResetPassword extends  \Illuminate\Auth\Notifications\ResetPassword
{
    /**
     * Where to redirect users after reset.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;


    protected function resetUrl($notifiable)
    {
        return url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));
    }
}
