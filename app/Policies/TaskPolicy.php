<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, Task $task)
    {
        // Define logic for who can delete the task
        return $user->id === $task->user_id; // Only allow the task owner
    }

    public function update(User $user, Task $task)
    {
        // Define logic for who can update the task
        return $user->id === $task->user_id; // Only allow the task owner
    }
}
