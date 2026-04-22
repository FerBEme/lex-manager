<?php
namespace App\Policies;
use App\Models\Folder;
use App\Models\User;
class FolderPolicy {
    public function viewAny(User $user): bool {
        return in_array($user->role_id,[1,2,3]);
    }
    public function view(User $user, Folder $folder): bool {
        if($user->role_id === 1)
            return true;
        if($user->role_id === 2)
            return $folder->case->lawyer_id === $user->id;
        if($user->role_id === 3)
            return $folder->case->lawyer_id === $user->lawyer_id;
        return false;
    }
    public function create(User $user): bool {
        return in_array($user->role_id,[1,2,3]);
    }
    public function update(User $user, Folder $folder): bool {
        if($user->role_id === 1)
            return true;
        if($user->role_id === 2)
            return $folder->case->lawyer_id === $user->id;
        if($user->role_id === 3)
            return $folder->case->lawyer_id === $user->lawyer_id;
        return false;
    }
    public function delete(User $user, Folder $folder): bool {
        return $user->role_id === 1;
    }
}