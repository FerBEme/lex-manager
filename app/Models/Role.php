<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Role extends Model {
    protected $fillable = ['name'];
    protected $casts = [
        'id'         => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function users(){
        return $this->hasMany(User::class,'role_id');
    }
}