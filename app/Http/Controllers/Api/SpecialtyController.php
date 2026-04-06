<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Specialty\StoreSpecialtyRequest;
use App\Http\Requests\Specialty\UpdateSpecialtyRequest;
use App\Http\Resources\SpecialtyResource;
use App\Models\Specialty;
class SpecialtyController extends Controller {
    public function index() {
        $specialties = Specialty::getOrPaginate();
        return SpecialtyResource::collection($specialties);
    }
    public function store(StoreSpecialtyRequest $request) {
        $data = $request->validated();
        $specialty = Specialty::create($data);
        return SpecialtyResource::make($specialty);
    }
    public function show(Specialty $specialty) {
        return SpecialtyResource::make($specialty);
    }
    public function update(UpdateSpecialtyRequest $request, Specialty $specialty) {
        $data = $request->validated();
        $specialty->update($data);
        return SpecialtyResource::make($specialty);
    }
    public function destroy(Specialty $specialty) {
        $specialty->delete();
        return response()->noContent();
    }
}