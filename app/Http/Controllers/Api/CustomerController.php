<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
class CustomerController extends Controller {
    public function index() {
        $customers = Customer::getOrPaginate();
        return CustomerResource::collection($customers);
    }
    public function store(StoreCustomerRequest $request) {
        $data = $request->validated();
        $customer = Customer::create($data);
        return CustomerResource::make($customer);
    }
    public function show(Customer $customer) {
        return CustomerResource::make($customer);
    }
    public function update(UpdateCustomerRequest $request, Customer $customer) {
        $data = $request->validated();
        $customer->update($data);
        return CustomerResource::make($customer);
    }
    public function destroy(Customer $customer) {
        $customer->delete();
        return response()->noContent();
    }
}
