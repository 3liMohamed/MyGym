<?php

namespace App\Policies;

use App\Models\ChooseUsItems;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChooseUsItemsPolicy
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
    public function view(User $user, ChooseUsItems $chooseUsItems): bool
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
    public function update(User $user, ChooseUsItems $chooseUsItems): bool
    {
        return $user->hasPermission('choose_us', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ChooseUsItems $chooseUsItems): bool
    {
        return $user->hasPermission('choose_us', 'delete');
    }

}
