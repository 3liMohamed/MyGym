<?php

namespace App\Policies;

use App\Models\PricingPlanFeature;
use App\Models\User;

class PricingPlanFeaturePolicy
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
    public function view(User $user, PricingPlanFeature $pricingPlanFeature): bool
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
    public function update(User $user, PricingPlanFeature $pricingPlanFeature): bool
    {
        return $user->hasPermission('pricing_plans', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PricingPlanFeature $pricingPlanFeature): bool
    {
        return $user->hasPermission('pricing_plans', 'delete');
    }
}
