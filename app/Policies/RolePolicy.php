<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;

use http\Env\Request;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Auth::user()->role->HasPermission('read-role');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(\Illuminate\Http\Request $request, Role $role): bool
    {

        return $request->user()->role->HasPermission(['update-role', 'edit-role']);

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role): bool
    {
        return false;
    }
}
