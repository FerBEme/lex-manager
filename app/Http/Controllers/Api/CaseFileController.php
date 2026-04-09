<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaseFile\StoreCaseFileRequest;
use App\Http\Requests\CaseFile\UpdateCaseFileRequest;
use App\Http\Resources\CaseFileResource;
use App\Models\CaseFile;
use Illuminate\Http\Request;
class CaseFileController extends Controller {
    public function index() {
        $caseFiles = CaseFile::getOrPaginate();
        return CaseFileResource::collection($caseFiles);
    }
    public function store(StoreCaseFileRequest $request) {
        $data = $request->validated();
        $caseFile = CaseFile::create($data);
        return CaseFileResource::make($caseFile->load(['specialty','status','location','lawyer','customer']));
    }
    public function show(CaseFile $caseFile) {
        return CaseFileResource::make($caseFile->load(['specialty','status','location','lawyer','customer']));
    }
    public function update(UpdateCaseFileRequest $request, CaseFile $caseFile) {
        $data = $request->validated();
        $caseFile->update($data);
        return CaseFileResource::make($caseFile->load(['specialty','status','location','lawyer','customer']));
    }
    public function destroy(CaseFile $caseFile) {
        $caseFile->delete();
        return response()->noContent();        
    }
}
