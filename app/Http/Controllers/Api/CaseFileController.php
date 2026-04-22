<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaseFile\StoreCaseFileRequest;
use App\Http\Requests\CaseFile\UpdateCaseFileRequest;
use App\Http\Resources\CaseFileResource;
use App\Models\CaseFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class CaseFileController extends Controller {
    public function index() {
        Gate::authorize('viewAny',CaseFile::class);
        $userAuth = Auth::guard('api')->user();
        $query = CaseFile::query();
        if($userAuth->role_id === 2)
            $query->where('lawyer_id',$userAuth->id);
        elseif($userAuth->role_id === 3)
            $query->where('lawyer_id',$userAuth->lawyer_id);
        $caseFiles = $query->getOrPaginate();
        return CaseFileResource::collection($caseFiles);
    }
    public function store(StoreCaseFileRequest $request) {
        Gate::authorize('create',CaseFile::class);
        $userAuth = Auth::guard('api')->user();
        if($userAuth->role_id === 2)
            $data['lawyer_id'] = $userAuth->id;
        elseif($userAuth->role_id === 3)
            $data['lawyer_id'] = $userAuth->lawyer_id;
        $data = $request->validated();
        $caseFile = CaseFile::create($data);
        return CaseFileResource::make($caseFile);
    }
    public function show(CaseFile $caseFile) {
        Gate::authorize('view',$caseFile);
        return CaseFileResource::make($caseFile);
    }
    public function update(UpdateCaseFileRequest $request, CaseFile $caseFile) {
        Gate::authorize('update',$caseFile);
        $userAuth = Auth::guard('api')->user();
        if($userAuth->role_id === 2)
            $data['lawyer_id'] = $userAuth->id;
        elseif($userAuth->role_id === 3)
            $data['lawyer_id'] = $userAuth->lawyer_id;
        $data = $request->validated();
        $caseFile->update($data);
        return CaseFileResource::make($caseFile);
    }
    public function destroy(CaseFile $caseFile) {
        Gate::authorize('delete',$caseFile);
        $caseFile->delete();
        return response()->noContent();
    }
}