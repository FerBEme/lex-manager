<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Notification extends Model {
    protected $fillable = [
        'message',
        'notification_time',
        'is_read',
        'user_id',
        'event_id',
    ];
    protected $casts = [
        'id'                => 'integer',
        'notification_time' => 'datetime',
        'is_read'           => 'boolean',
        'user_id'           => 'integer',
        'event_id'          => 'integer',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function event(){
        return $this->belongsTo(Event::class,'event_id');
    }
}