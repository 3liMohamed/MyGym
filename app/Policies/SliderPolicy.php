<?php

namespace App\Policies;

use App\Models\Slider;
use App\Models\User;

class SliderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('sliders', 'view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Slider $slider): bool
    {
        return $user->hasPermission('sliders', 'view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('sliders', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Slider $slider): bool
    {
        return $user->hasPermission('sliders', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Slider $slider): bool
    {
        return $user->hasPermission('sliders', 'delete');
    }

}
