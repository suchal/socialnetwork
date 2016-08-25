<?php

namespace App\Policies;

use App\User;
use App\profile;
use Illuminate\Auth\Access\HandlesAuthorization;

class profilePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show(User $user, profile $profile)
    {
        # code...
    }

    public function update(User $user, profile $profile)
    {
        return $profile->id == $user->profile_id;
    }

}
