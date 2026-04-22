<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\File\StoreFileRequest;
use App\Http\Requests\File\UpdateFileRequest;
use App\Http\Resources\FileResource;
use App\Models\CaseFile;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
class FileController extends Controller {
    public function index() {
        Gate::authorize('viewAny',File::class);
        $userAuth = Auth::guard('api')->user();
        $query = File::query();
        if($userAuth->role->name === 'lawyer') {
            $caseFilesIds = CaseFile::where('lawyer_id',$userAuth->id)->pluck('id');
            $foldersIds = Folder::whereIn('case_id',$caseFilesIds)->pluck('id');
            $query->whereIn('folder_id',$foldersIds);
        }
        elseif($userAuth->role->name === 'secretary') {
            $caseFilesIds = CaseFile::where('lawyer_id',$userAuth->lawyer_id)->pluck('id');
            $foldersIds = Folder::whereIn('case_id',$caseFilesIds)->pluck('id');
            $query->whereIn('folder_id',$foldersIds);
        }
        if(request('filters')){
            foreach (request('filters') as $column => $conditions) {
                foreach ($conditions as $operator => $value) {
                    if(in_array($operator,['!=','=','<=','<','>=','>'])) $query->where($column,$operator,$value);
                    if($operator === 'like') $query->where($column,'like',"%$value%");
                }
            }
        }
        if(request('select')) $query->select(explode(',',request('select')));
        if(request('sort')){
            foreach (explode(',',request('sort')) as $sort) {
                $direction = 'asc';
                if(substr($sort,0,1) === '-'){
                    $direction = 'desc';
                    $sort = substr($sort,1);
                }
                $query->orderBy($sort,$direction);
            }
        }
        if(request('include')) $query->with(explode(',',request('include')));
        if(request('perPage')) $files = $query->paginate(request('perPage'));
        else $files = $query->get();
        return FileResource::collection($files);
    }
    public function store(StoreFileRequest $request) {
        Gate::authorize('create',File::class);
        $userAuth = Auth::guard('api')->user();
        $data = $request->validated();
        $folder = Folder::with('case')->findOrFail($data['folder_id']);
        if($userAuth->role->name === 'lawyer') {
            if($folder->case->lawyer_id !== $userAuth->id)
                abort(403, 'No puedes subir archivos a este folder');
        }
        if($userAuth->role->name === 'secretary') {
            if($folder->case->lawyer_id !== $userAuth->lawyer_id)
                abort(403, 'No puedes subir archivos a este folder');
        }
        $data['file_type'] = $request->file('file_path')->extension();
        $existingFile = File::where('folder_id',$data['folder_id'])
            ->where('file_name',$data['file_name'])
            ->orderByDesc('version')
            ->first();
        $data['version'] = $existingFile ? $existingFile->version +1 : 1;
        if ($request->hasFile('file_path')) 
            $data['file_path'] = Storage::put('files',$request->file('file_path'));
        $data['uploaded_by'] = $userAuth->id;
        $file = File::create($data);
        return FileResource::make($file);
    }
    public function show(File $file) {
        Gate::authorize('view',$file);
        return FileResource::make($file);
    }
    public function update(UpdateFileRequest $request, File $file) {
        Gate::authorize('update',$file);
        $userAuth = Auth::guard('api')->user();
        if($userAuth->role->name === 'lawyer'){
            if($file->folder->case->lawyer_id !== $userAuth->id)
                abort(403, 'No puedes modificar este archivo');
        }
        if($userAuth->role->name === 'secretary'){
            if($file->folder->case->lawyer_id !== $userAuth->lawyer_id)
                abort(403, 'No puedes modificar este archivo');
        }
        $data = $request->validated();
        $fileName = $data['file_name'] ?? $file->file_name;
        $latestVersion = File::where('folder_id',$file->folder_id)
            ->where('file_name',$fileName)
            ->max('version');
        $newVersion = $latestVersion ? $latestVersion + 1 : 1;
        if ($request->hasFile('file_path')) 
            $path = Storage::put('files',$request->file('file_path'));
        $newFile = File::create([
            'file_name' => $fileName,
            'file_path' => $path,
            'file_type' => $request->file('file_path')->extension(),
            'version' => $newVersion,
            'folder_id' => $file->folder_id,
            'uploaded_by' => $userAuth->id,
        ]);
        return FileResource::make($newFile);
    }
    public function destroy(File $file) {
        Gate::authorize('delete',$file);
        $userAuth = Auth::guard('api')->user();
        if($userAuth->role->name === 'lawyer') {
            if($file->folder->case->lawyer_id !== $userAuth->id) abort(403);
        }
        if($userAuth->role->name === 'secretary') {
            if($file->folder->case->lawyer_id !== $userAuth->lawyer_id) abort(403);
                $created = $file->created_at;
            if($file->uploaded_by !== $userAuth->id || now()->diffInHours($created) > 24)
                abort(403, 'No puedes editar esta carpeta');
        }
        $file->delete();
        return response()->noContent();
    }
}