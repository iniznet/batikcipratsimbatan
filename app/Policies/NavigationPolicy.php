<?php

namespace App\Policies;

use App\Models\Management\User;
use RyanChandler\FilamentNavigation\Models\Navigation;
use Illuminate\Auth\Access\HandlesAuthorization;

class NavigationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_navigation');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Management\User  $user
     * @param  \RyanChandler\FilamentNavigation\Models\Navigation  $navigation
     * @return bool
     */
    public function view(User $user, Navigation $navigation): bool
    {
        return $user->can('view_navigation');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_navigation');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Management\User  $user
     * @param  \RyanChandler\FilamentNavigation\Models\Navigation  $navigation
     * @return bool
     */
    public function update(User $user, Navigation $navigation): bool
    {
        return $user->can('update_navigation');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Management\User  $user
     * @param  \RyanChandler\FilamentNavigation\Models\Navigation  $navigation
     * @return bool
     */
    public function delete(User $user, Navigation $navigation): bool
    {
        return $user->can('delete_navigation');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_navigation');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\Management\User  $user
     * @param  \RyanChandler\FilamentNavigation\Models\Navigation  $navigation
     * @return bool
     */
    public function forceDelete(User $user, Navigation $navigation): bool
    {
        return $user->can('force_delete_navigation');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_navigation');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\Management\User  $user
     * @param  \RyanChandler\FilamentNavigation\Models\Navigation  $navigation
     * @return bool
     */
    public function restore(User $user, Navigation $navigation): bool
    {
        return $user->can('restore_navigation');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_navigation');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\Management\User  $user
     * @param  \RyanChandler\FilamentNavigation\Models\Navigation  $navigation
     * @return bool
     */
    public function replicate(User $user, Navigation $navigation): bool
    {
        return $user->can('replicate_navigation');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_navigation');
    }

}
