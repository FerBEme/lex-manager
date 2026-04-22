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
        if(request('filters')){
            foreach (request('filters') as $column => $conditions) {
                foreach ($conditions as $operator => $value) {
                    if (in_array($operator,['!=','=','>','>=','<','<='])) $query->where($column,$operator,$value);
                    if ($operator === 'like') $query->where($column,'like',"%$value%");
                }
            }
        }
        if (request('select')) $query->select(explode(',',request('select')));
        if (request('sort')) {
            foreach (explode(',',request('sort')) as $sort) {
                $direction = 'asc';
                if (substr($sort,0,1) === '-') {
                    $direction = 'desc';
                    $sort = substr($sort,1);
                }
                $query->orderBy($sort,$direction);
            }
        }
        if (request('perPage')) $customers = $query->paginate(request('perPage'));
        else $customers = $query->get();
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