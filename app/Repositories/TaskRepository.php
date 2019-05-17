<?php

namespace App\Repositories;

use App\User;

class TaskRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->tasks()
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    public function forUserToTransfer(User $user)
    {
        $tasks = $user->tasks()->orderBy('created_at', 'asc')->get();
        return $tasks->reject(function ($task) {
            return $task->transfers()->where('status', 'Waiting')->get()->count() > 0;
        });
    }
}
