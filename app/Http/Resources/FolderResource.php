<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class FolderResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'case_file_id' => $this->caseFile,
            'parent_folder_id' => $this->parent_folder_id,
            'creado_por' => $this->created_by,
        ];
    }
}