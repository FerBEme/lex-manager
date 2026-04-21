<?php
namespace App\Policies;

use App\Models\CaseFile;
use App\Models\Customer;
use App\Models\User;
class CustomerPolicy {
    public function viewAny(User $user): bool {
        return in_array($user->role_id,[1,2,3]);
    }
    public function view(User $user, Customer $customer): bool {
        if($user->role_id === 1) return true;
        if($user->role_id === 2)
            return CaseFile::where('lawyer_id',$user->id)
                ->where('customer_id',$customer->id)
                ->exists();
        if($user->role_id === 3)
            return CaseFile::where('lawyer_id',$user->lawyer_id)
                ->where('customer_id',$customer->id)
                ->exists();
        return false;
    }
    public function create(User $user): bool {
        return in_array($user->role_id,[1,2,3]);
    }
    public function update(User $user, Customer $customer): bool {
        return $this->view($user, $customer);
    }
    public function delete(User $user, Customer $customer): bool {
        return $user->role_id === 1;
    }
}