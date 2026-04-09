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
    protected $casts = [
        'id' => 'integer'
    ];
    public function permissions(){
        return $this->belongsToMany(
            Permission::class,
            'role_permission',
            'role_id',
            'permission_id'
        );
    }
    public function users(){
        return $this->belongsToMany(
            User::class,
            'role_user',
            'role_id',
            'user_id'
        );
    }
}