<?php

namespace App\Observers;

use App\Entity\User;

class UserObserver
{
    /**
     * Handle the user "deleting" event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        $user->vacations()->delete();
    }
}
