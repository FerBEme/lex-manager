<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class EventParticipant extends Model {
    public $timestamps = false;
    protected $fillable = [
        'event_id',
        'user_id',
        'customer_id',
    ];
    protected $casts = [
        'id' => 'integer',
        'event_id' => 'integer',
        'user_id' => 'integer',
        'customer_id' => 'integer',
    ];
    public function event(){
        return $this->belongsTo(Event::class,'event_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
}