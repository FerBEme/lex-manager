<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class CustomerController extends Controller {
    public function index() {
        Gate::authorize('viewAny',Customer::class);
        $userAuth = Auth::guard('api')->user();
        $query = Customer::query();
        if($userAuth->role_id === 2){
            $query->whereHas('caseFiles',function ($q) use ($userAuth) {
                $q->where('lawyer_id',$userAuth->id);
            });
        }
        elseif ($userAuth->role_id === 3) {
            $query->whereHas('caseFiles',function ($q) use ($userAuth) {
                $q->where('lawyer_id',$userAuth->lawyer_id);
            });
        }
        $customers = $query->getOrPaginate();
        return CustomerResource::collection($customers);
    }
    public function store(StoreCustomerRequest $request) {
        Gate::authorize('create',Customer::class);
        $data = $request->validated();
        $customer = Customer::create($data);
        return CustomerResource::make($customer);
    }
    public function show(Customer $customer) {
        Gate::authorize('view',$customer);
        return CustomerResource::make($customer);
    }
    public function update(UpdateCustomerRequest $request, Customer $customer) {
        Gate::authorize('update',$customer);
        $data = $request->validated();
        $customer->update($data);
        return CustomerResource::make($customer);
    }
    public function destroy(Customer $customer) {
        Gate::authorize('delete',$customer);
        $customer->delete();
        return response()->noContent();
    }
}