<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AuditLog extends Model {
    public $timestamps = false;
    protected $fillable = [
        'action',
        'table_name',
        'record_id',
        'user_id',
    ];
    protected $casts = [
        'id' => 'integer',
        'record_id' => 'integer',
        'user_id' => 'integer',
        'created_at' => 'datetime',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}