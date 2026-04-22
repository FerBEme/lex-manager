<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Folder\StoreFolderRequest;
use App\Http\Requests\Folder\UpdateFolderRequest;
use App\Http\Resources\FolderResource;
use App\Models\CaseFile;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class FolderController extends Controller {
    public function index() {
        Gate::authorize('viewAny', Folder::class);
        $userAuth = Auth::guard('api')->user();
        $query = Folder::query();
        if ($userAuth->role_id === 2) {
            $query->whereHas('case', function ($q) use ($userAuth) {
                $q->where('lawyer_id', $userAuth->id);
            });
        } elseif ($userAuth->role_id === 3) {
            $query->whereHas('case', function ($q) use ($userAuth) {
                $q->where('lawyer_id', $userAuth->lawyer_id);
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
        if (request('include')) $query->with(explode(',',request('include')));
        if (request('perPage')) $folders = $query->paginate(request('perPage'));
        else $folders = $query->get();
        return FolderResource::collection($folders);
    }
    public function store(StoreFolderRequest $request) {
        Gate::authorize('create',Folder::class);
        $userAuth = Auth::guard('api')->user();
        $data = $request->validated();
        $case = CaseFile::find($data['case_id']);
        if($userAuth->role_id === 2){
            if ($case->lawyer_id !== $userAuth->id)
                abort(403, 'No puedes crear carpetas en este expediente');
        }
        if($userAuth->role_id === 3){
            if($case->lawyer_id !== $userAuth->lawyer_id)
                abort(403, 'No puedes crear carpetas en este expediente');
        }
        $data['created_by'] = $userAuth->id;
        $folder = Folder::create($data);
        return FolderResource::make($folder);
    }
    public function show(Folder $folder) {
        Gate::authorize('view',$folder);
        $userAuth = Auth::guard('api')->user();
        if($userAuth->role_id === 2) {
            if($folder->case->lawyer_id !== $userAuth->id) abort(403);
        }
        if($userAuth->role_id === 3) {
            if($folder->case->lawyer_id !== $userAuth->lawyer_id) abort(403);
        }
        return FolderResource::make($folder);
    }
    public function update(UpdateFolderRequest $request, Folder $folder) {
        Gate::authorize('update',$folder);
        $userAuth = Auth::guard('api')->user();
        $data = $request->validated();
        if($userAuth->role_id === 2) {
            if($folder->case->lawyer_id !== $userAuth->id) abort(403);
        }
        if($userAuth->role_id === 3) {
            if($folder->case->lawyer_id !== $userAuth->lawyer_id) abort(403);
            $created = $folder->created_at;
            if($folder->created_by !== $userAuth->id || now()->diffInHours($created) > 24)
                abort(403, 'No puedes editar esta carpeta');
        }
        $folder->update($data);
        return FolderResource::make($folder);
    }
    public function destroy(Folder $folder) {
        Gate::authorize('delete',$folder);
        $folder->delete();
        return response()->noContent();
    }
}