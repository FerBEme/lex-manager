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
        if($userAuth->role_id === 2) $query->where('lawyer_id',$userAuth->id);
        elseif($userAuth->role_id === 3) $query->where('lawyer_id',$userAuth->lawyer_id);
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
        if (request('include')) $query->with(explode(',',request('include')));
        if (request('perPage')) $caseFiles = $query->paginate(request('perPage'));
        else $caseFiles = $query->get();
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