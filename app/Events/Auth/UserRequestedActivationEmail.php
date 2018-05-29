<?php

namespace App\Events\Auth;


use Illuminate\Queue\SerializesModels;
use App\User;
use Illuminate\Foundation\Events\Dispatchable;



class UserRequestedActivationEmail
{
    use Dispatchable, SerializesModels;

    public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


}
