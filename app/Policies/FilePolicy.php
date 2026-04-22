<?php
namespace App\Policies;
use App\Models\File;
use App\Models\User;
class FilePolicy {
    public function viewAny(User $user): bool {
        return in_array($user->role->name,['admin','lawyer','secretary']);
    }
    public function view(User $user, File $file): bool {
        if($user->role->name === 'admin')
            return true;
        if($user->role->name === 'lawyer')
            return $file->folder->case->lawyer_id === $user->id;
        if($user->role->name === 'secretary')
            return $file->folder->case->lawyer_id === $user->lawyer_id;
        return false;
    }
    public function create(User $user): bool{
        return in_array($user->role->name,['admin','lawyer','secretary']);
    }
    public function update(User $user, File $file): bool {
        if($user->role->name === 'admin')
            return true;
        if($user->role->name === 'lawyer')
            return $file->folder->case->lawyer_id === $user->id;
        if($user->role->name === 'secretary')
            return $file->folder->case->lawyer_id === $user->lawyer_id;
        return false;
    }
    public function delete(User $user, File $file): bool{
        return in_array($user->role->name,['admin','lawyer','secretary']);
    }
}