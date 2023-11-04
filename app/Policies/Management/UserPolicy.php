<?php

namespace App\Policies\Management;

use App\Models\Management\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        return $user->can('view_any_management::user');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function view(User $user): bool
    {
        return $user->can('view_management::user');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_management::user');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function update(User $user): bool
    {
        return $user->can('update_management::user');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->can('delete_management::user');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_management::user');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function forceDelete(User $user): bool
    {
        return $user->can('force_delete_management::user');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_management::user');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function restore(User $user): bool
    {
        return $user->can('restore_management::user');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_management::user');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function replicate(User $user): bool
    {
        return $user->can('replicate_management::user');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_management::user');
    }
}
