<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class EventType extends Model {
    protected $fillable = ['name'];
    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function events(){
        return $this->hasMany(Event::class,'event_type_id');
    }
}