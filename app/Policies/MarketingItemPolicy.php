<?php

namespace App\Policies;

use App\Models\MarketingItem;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MarketingItemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('marketing_items', 'view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MarketingItem $marketingItem): bool
    {
        return $user->hasPermission('marketing_items', 'view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('marketing_items', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MarketingItem $marketingItem): bool
    {
        return $user->hasPermission('marketing_items', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MarketingItem $marketingItem): bool
    {
        return $user->hasPermission('marketing_items', 'delete');
    }

}
