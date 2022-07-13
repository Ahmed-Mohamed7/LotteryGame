<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

   

    /**
     * Determine if the given post can be updated by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function view(User $user1, User $user2)
    {
        // dd($user1->id,$user2->id);
        return $user1->id === $user2->id;
    }
}
