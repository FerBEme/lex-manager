<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class File extends Model {
    use HasFactory;
    protected $table = 'files';
    protected $fillable = [
        'name',
        'original_name',
        'file_type',
        'mime_type',
        'file_size',
        'storage_path',
        'folder_id',
        'uploaded_by',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'file_size' => 'integer',
        'folder_id' => 'integer',
        'uploaded_by' => 'integer',
    ];
    public function folder(){
        return $this->belongsTo(Folder::class,'folder_id');
    }
    public function uploator(){
        return $this->belongsTo(User::class,'uploaded_by');
    }
}
