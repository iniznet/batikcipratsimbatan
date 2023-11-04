<?php

namespace App\Policies;

use App\Models\Management\User;
use Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthenticationLogPolicy
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
        return $user->can('view_any_management::authentication::log');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Management\User  $user
     * @param  \Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog  $authenticationLog
     * @return bool
     */
    public function view(User $user, AuthenticationLog $authenticationLog): bool
    {
        return $user->can('view_management::authentication::log');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_management::authentication::log');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Management\User  $user
     * @param  \Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog  $authenticationLog
     * @return bool
     */
    public function update(User $user, AuthenticationLog $authenticationLog): bool
    {
        return $user->can('update_management::authentication::log');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Management\User  $user
     * @param  \Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog  $authenticationLog
     * @return bool
     */
    public function delete(User $user, AuthenticationLog $authenticationLog): bool
    {
        return $user->can('delete_management::authentication::log');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_management::authentication::log');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\Management\User  $user
     * @param  \Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog  $authenticationLog
     * @return bool
     */
    public function forceDelete(User $user, AuthenticationLog $authenticationLog): bool
    {
        return $user->can('force_delete_management::authentication::log');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_management::authentication::log');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\Management\User  $user
     * @param  \Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog  $authenticationLog
     * @return bool
     */
    public function restore(User $user, AuthenticationLog $authenticationLog): bool
    {
        return $user->can('restore_management::authentication::log');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_management::authentication::log');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\Management\User  $user
     * @param  \Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog  $authenticationLog
     * @return bool
     */
    public function replicate(User $user, AuthenticationLog $authenticationLog): bool
    {
        return $user->can('replicate_management::authentication::log');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\Management\User  $user
     * @return bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_management::authentication::log');
    }

}
