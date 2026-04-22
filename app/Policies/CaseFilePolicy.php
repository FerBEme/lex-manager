<?php
namespace App\Policies;
use App\Models\CaseFile;
use App\Models\User;
class CaseFilePolicy {
    public function viewAny(User $user): bool {
        return in_array($user->role_id,[1,2,3]);
    }
    public function view(User $user, CaseFile $caseFile): bool {
        if($user->role_id === 1)
            return true;
        if($user->role_id === 2)
            return $user->id === $caseFile->lawyer_id;
        if($user->role_id === 3)
            return $user->lawyer_id === $caseFile->lawyer_id;
        return false;
    }
    public function create(User $user): bool {
        return in_array($user->role_id,[1,2,3]);
    }
    public function update(User $user, CaseFile $caseFile): bool {
        if($user->role_id === 1)
            return true;
        if($user->role_id === 2)
            return $user->id === $caseFile->lawyer_id;
        if($user->role_id === 3)
            return $user->lawyer_id === $caseFile->lawyer_id;
        return false;
    }
    public function delete(User $user, CaseFile $caseFile): bool {
        if($user->role_id === 1)
            return true;
        if($user->role_id === 2)
            return $user->id === $caseFile->lawyer_id;
        if($user->role_id === 3)
            return $user->lawyer_id === $caseFile->lawyer_id;
        return false;
    }
}