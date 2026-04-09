<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Folder extends Api {
    use HasFactory;
    protected $table = 'folders';
    protected $fillable = [
        'name',
        'case_file_id',
        'parent_folder_id',
        'created_by',
    ];
    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'case_file_id' => 'integer',
        'parent_folder_id' => 'integer',
        'created_by' => 'integer',
    ];
    public function caseFile(){
        return $this->belongsTo(CaseFile::class,'case_file_id');
    }
    public function parentFolder(){
        return $this->belongsTo(Folder::class,'parent_folder_id');
    }
    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function folders(){
        return $this->hasMany(Folder::class,'parent_folder_id');
    }
    public function files(){
        return $this->hasMany(File::class,'folder_id');
    }
}