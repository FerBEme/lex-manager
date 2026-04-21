<?php
namespace App\Policies;
use App\Models\User;
class UserPolicy {
    public function viewAny(User $user): bool {
        return in_array($user->role_id,[1,2]);
    }
    public function view(User $user, User $model): bool {
        if($user->role_id === 1)
            return true;
        if($user->role_id === 2)
            return $model->lawyer_id === $user->id;
        if($user->role_id === 3)
            return $user->id === $model->id;
        return false;
    }
    public function create(User $user): bool {
        return in_array($user->role_id,[1,2]);
    }
    public function update(User $user, User $model): bool {
        if($user->role_id === 1)
            return true;
        if($user->role_id === 2)
            return $user->id === $model->id || $model->lawyer_id === $user->id;
        if($user->role_id === 3)
            return $user->id === $model->id;
        return false;
    }
    public function delete(User $user, User $model): bool {
        if($user->id === $model->id)
            return false;
        if($user->role_id === 1)
            return true;
        if($user->role_id === 2)
            return $model->lawyer_id === $user->id;
        return false;
    }
}