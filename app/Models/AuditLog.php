<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AuditLog extends Model {
    protected $table = 'audit_logs';
    public $timestamps = false;
    protected $fillable = [
        'actions_taken',
        'affected_entity',
        'affected_record_identifier',
        'old_values',
        'new_values',
        'authenticated_user',
        'created_at',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'affected_record_identifier' => 'integer',
        'old_values' => 'array',
        'new_values' => 'array',
        'authenticated_user' => 'integer'
    ];
    public function authenticatedUser(){
        return $this->belongsTo(User::class,'authenticated_user');
    }
}
