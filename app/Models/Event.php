<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Event extends Model {
    use HasFactory;
    protected $table = 'events';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'description',
        'start_datetime',
        'end_datetime',
        'meeting_link',
        'event_type_id',
        'case_file_id',
        'created_by',
        'created_at',
    ];
    protected $casts = [
        'event_type_id' => 'integer',
        'case_file_id' => 'integer',
        'created_by' => 'integer',
        'created_at' => 'datetime',
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
    ];
    public function eventType(){
        return $this->belongsTo(EventType::class,'event_type_id');
    }
    public function caseFile(){
        return $this->belongsTo(CaseFile::class,'case_file_id');
    }
    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }
}
