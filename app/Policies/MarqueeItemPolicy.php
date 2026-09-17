<?php

namespace App\Policies;

use App\Models\MarqueeItem;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MarqueeItemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('marquee_items', 'view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MarqueeItem $marqueeItem): bool
    {
        return $user->hasPermission('marquee_items', 'view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('marquee_items', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MarqueeItem $marqueeItem): bool
    {
        return $user->hasPermission('marquee_items', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MarqueeItem $marqueeItem): bool
    {
        return $user->hasPermission('marquee_items', 'delete');
    }

}
