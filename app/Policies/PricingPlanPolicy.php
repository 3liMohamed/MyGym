<?php

namespace App\Policies;

use App\Models\PricingPlan;
use App\Models\User;

class PricingPlanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('pricing_plans', 'view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PricingPlan $pricingPlan): bool
    {
        return $user->hasPermission('pricing_plans', 'view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('pricing_plans', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PricingPlan $pricingPlan): bool
    {
        return $user->hasPermission('pricing_plans', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PricingPlan $pricingPlan): bool
    {
        return $user->hasPermission('pricing_plans', 'delete');
    }

}
