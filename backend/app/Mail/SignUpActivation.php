<?php

namespace App\Mail;

use App\Player;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SignUpActivation extends Mailable
{
    use Queueable, SerializesModels;

    public $player;
    public $frontendUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Player $player)
    {
        $this->player = $player;
        $this->frontendUrl = env("FRONTEND_URL");
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from("mob@stylersonline.com")
            ->text("emails/sign-up-activation");
    }
}
