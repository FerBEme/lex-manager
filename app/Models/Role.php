<?php
namespace App\Models;
use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Model;
class Role extends Model {
    use ApiTrait;
    protected $table = 'roles';
    public $timestamps = false;
    protected $fillable = [
        'role_code',
        'name',
        'description',
    ];
    public function roles(){
        return $this->belongsToMany(
            User::class,
            'role_user',
            'role_id',
            'user_id'
        );
    }
}