<?php

namespace App\Policies;

use App\Models\GymClass;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GymClassPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('gym_classes', 'view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, GymClass $gymClass): bool
    {
        return $user->hasPermission('gym_classes', 'view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('gym_classes', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, GymClass $gymClass): bool
    {
        return $user->hasPermission('gym_classes', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, GymClass $gymClass): bool
    {
        return $user->hasPermission('gym_classes', 'delete');
    }

}
