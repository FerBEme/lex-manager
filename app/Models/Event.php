<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Event extends Model {
    protected $fillable = [
        'title',
        'description',
        'start_datetime',
        'end_datetime',
        'location',
        'meeting_link',
        'event_type_id',
        'case_id',
        'created_by',
    ];
    protected $casts = [
        'id'             => 'integer',
        'start_datetime' => 'datetime',
        'end_datetime'   => 'datetime',
        'event_type_id'  => 'integer',
        'case_id'        => 'integer',
        'created_by'     => 'integer',
        'created_at'     => 'datetime',
        'updated_at'     => 'datetime',
    ];
    public function eventType(){
        return $this->belongsTo(EventType::class,'event_type_id');
    }
    public function case(){
        return $this->belongsTo(CaseFile::class,'case_id');
    }
    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function eventParticipants(){
        return $this->hasMany(EventParticipant::class,'event_participants');
    }
    public function notifications(){
        return $this->hasMany(Notification::class,'event_id');
    }
}