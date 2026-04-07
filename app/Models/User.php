<?php
namespace App\Models;
use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class User extends Model {
    use HasFactory, ApiTrait;
    protected $table = 'users';
    protected $fillable = [
        'document_type',
        'document_number',
        'names',
        'paternal_surname',
        'maternal_surname',
        'email',
        'password',
        'phone',
        'lawyer_id',
        'tuition_number',
        'profile_photo',
        'is_active',
        'last_login_at',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'password' => 'hashed',
        'lawyer_id' => 'integer',
        'is_active' => 'integer',
    ];
    public function lawyer(){
        return $this->belongsTo(User::class,'lawyer_id');
    }
    public function users(){
        return $this->hasMany(User::class,'lawyer_id');
    }
    public function roles(){
        return $this->belongsToMany(
            Role::class,
            'role_user',
            'user_id',
            'role_id'
        );
    }
    public function specialties(){
        return $this->belongsToMany(
            Specialty::class,
            'lawyer_specialty',
            'lawyer_id',
            'specialty_id'
        );
    }
    public function caseFiles(){
        return $this->hasMany(CaseFile::class, 'lawyer_id');
    }
    public function folders(){
        return $this->hasMany(Folder::class,'created_by');
    }
    public function files(){
        return $this->hasMany(File::class,'uploaded_by');
    }
    public function aufitLogs(){
        return $this->hasMany(AuditLog::class,'authenticated_user');
    }
    public function events(){
        return $this->hasMany(Event::class,'created_by');
    }
    public function templates(){
        return $this->hasMany(Template::class,'created_by');
    }
}
