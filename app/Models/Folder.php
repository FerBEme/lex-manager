<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Folder extends Model {
    protected $fillable = [
        'name',
        'parent_id',
        'case_id',
        'created_by',
    ];
    protected $casts = [
        'id'         => 'integer',
        'parent_id'  => 'integer',
        'case_id'    => 'integer',
        'created_by' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function parent(){
        return $this->belongsTo(Folder::class,'parent_id');
    }
    public function folders(){
        return $this->hasMany(Folder::class,'parent_id');
    }
    public function case(){
        return $this->belongsTo(CaseFile::class,'case_id');
    }
    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function files(){
        return $this->hasMany(File::class,'folder_id');
    }
}