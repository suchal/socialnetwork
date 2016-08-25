<?php

namespace App\Policies;

use App\User;
use App\comment;
use App\status;
use Illuminate\Auth\Access\HandlesAuthorization;

class commentPolicy
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

    public function create(User $user)
    {
        
    }

    public function update(User $user, comment $comment)
    {
        return $user->owns($comment);
    }

    public function delete(User $user, comment $comment)
    {
        return ($user->owns($comment) || $user->owns($comment->status));   
    }
}
