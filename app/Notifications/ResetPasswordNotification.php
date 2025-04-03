<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    public $token;
    public $routeName;

    public function __construct($token, $routeName = 'admin.password.reset')
    {
        $this->token = $token;
        $this->routeName = $routeName;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Redefinição de Senha')
            ->line('Você está recebendo este e-mail porque recebemos um pedido de redefinição de senha para sua conta.')
            ->action('Redefinir Senha', url(route($this->routeName, ['token' => $this->token, 'email' => $notifiable->email], false)))
            ->line('Se você não solicitou uma redefinição de senha, ignore este e-mail.');
    }
}
