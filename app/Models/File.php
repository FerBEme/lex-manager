<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class File extends Model {
    use HasFactory;
    protected $fillable = [
        'file_name',
        'file_path',
        'file_type',
        'version',
        'folder_id',
        'uploaded_by',
    ];
    protected $casts = [
        'id'          => 'integer',
        'version'     => 'integer',
        'folder_id'   => 'integer',
        'uploaded_by' => 'integer',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];
    public function folder(){
        return $this->belongsTo(Folder::class,'folder_id');
    }
    public function uploator(){
        return $this->belongsTo(User::class,'uploaded_by');
    }
}