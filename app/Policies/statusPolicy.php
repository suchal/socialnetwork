<?php

namespace App\Policies;

use App\User;
use App\status;
use Illuminate\Auth\Access\HandlesAuthorization;

class statusPolicy
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

    public function update(User $user, status $status){
        return $user->owns($status);
    }

    public function delete(User $user, status $status){
        return $user->owns($status);
    }

    public function create(User $user){
        
    }

    public function show(User $user, status $status)
    {
        
    }

    public function comment(User $user, status $status){
        if($status->user->id == $user->id) return true;
        if($status->user->isFriend($user)) return true;
        return false;
    }
}
