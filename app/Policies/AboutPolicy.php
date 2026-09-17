<?php

namespace App\Policies;

use App\Models\About;
use App\Models\User;

class AboutPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('abouts', 'view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, About $about): bool
    {
        return $user->hasPermission('abouts', 'view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('abouts', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, About $about): bool
    {
        return $user->hasPermission('abouts', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, About $about): bool
    {
        return $user->hasPermission('abouts', 'delete');
    }


    public function activate(User $user, About $about): bool
    {
        return $user->hasPermission('abouts', 'activate');
    }
}
