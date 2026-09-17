<?php

namespace App\Policies;

use App\Models\ChooseUs;
use App\Models\User;

class ChooseUsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('choose_us', 'view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ChooseUs $chooseUs): bool
    {
        return $user->hasPermission('choose_us', 'view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('choose_us', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ChooseUs $chooseUs): bool
    {
        return $user->hasPermission('choose_us', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ChooseUs $chooseUs): bool
    {
        return $user->hasPermission('choose_us', 'delete');
    }

    public function activate(User $user, ChooseUs $chooseUs): bool
    {
        return $user->hasPermission('abouts', 'activate');
    }

}
