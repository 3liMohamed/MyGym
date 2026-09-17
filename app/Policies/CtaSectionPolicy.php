<?php

namespace App\Policies;

use App\Models\CtaSection;
use App\Models\User;

class CtaSectionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('cta_sections', 'view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CtaSection $ctaSection): bool
    {
        return $user->hasPermission('cta_sections', 'view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('cta_sections', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CtaSection $ctaSection): bool
    {
        return $user->hasPermission('cta_sections', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CtaSection $ctaSection): bool
    {
        return $user->hasPermission('cta_sections', 'delete');
    }


    public function activate(User $user, CtaSection $ctaSection): bool
    {
        return $user->hasPermission('cta_sections', 'activate');
    }

}
