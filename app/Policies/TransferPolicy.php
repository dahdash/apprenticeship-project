<?php

namespace App\Policies;

use App\User;
use App\Transfer;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransferPolicy
{
    use HandlesAuthorization;

    public function cancel(User $user, Transfer $transfer)
    {
        if ($transfer->status != 'Waiting')
            return false;
        return $user->id === $transfer->from_user_id;
    }

    public function respond(User $user, Transfer $transfer)
    {
        if ($transfer->status != 'Waiting')
            return false;
        return $user->id === $transfer->to_user_id;
    }

}
