<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class EventType extends Model {
    use HasFactory;
    protected $table = 'event_types';
    public $timestamps = false;
    protected $fillable = [
        'event_code',
        'name',
        'description',
    ];
    public function events(){
        return $this->hasMany(Event::class,'event_type_id');
    }
}
