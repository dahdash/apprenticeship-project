<?php

namespace App\Policies;

use App\User;
use App\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
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

    public function destroy(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    public function transfer(User $user, Task $task)
    {
        if ($user->id != $task->user_id)
            return false;
        if ($task->transfers()->where('status', 'Waiting')->get()->count() > 0)
            return false;
        return true;
    }
}
