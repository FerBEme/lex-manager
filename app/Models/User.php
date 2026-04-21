<?php
namespace App\Models;
use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject{
    use HasFactory, Notifiable,ApiTrait;
    protected $fillable = [
        'document_type',
        'nro_document',
        'first_name',
        'paternal_name',
        'maternal_name',
        'email',
        'password',
        'phone',
        'register_cal',
        'profile_photo',
        'is_active',
        'role_id',
        'lawyer_id',
    ];
    protected $hidden = ['password'];
    protected $casts = [
        'id'        => 'integer',
        'password'  => 'hashed',
        'role_id'   => 'integer',
        'lawyer_id' => 'integer',
    ];
    public function role(){
        return $this->belongsTo(Role::class,'role_id');
    }
    public function lawyer(){
        return $this->belongsTo(User::class,'lawyer_id');
    }
    public function secretaries(){
        return $this->hasMany(User::class,'lawyer_id');
    }
    public function caseFiles(){
        return $this->hasMany(CaseFile::class,'lawyer_id');
    }
    public function folders(){
        return $this->hasMany(Folder::class,'created_by');
    }
    public function files(){
        return $this->hasMany(File::class,'uploaded_by');
    }
    public function events(){
        return $this->hasMany(Event::class,'created_by');
    }
    public function eventParticipants(){
        return $this->hasMany(EventParticipant::class,'user_id');
    }
    public function notifications(){
        return $this->hasMany(Notification::class,'user_id');
    }
    public function auditLogs(){
        return $this->hasMany(AuditLog::class,'user_id');
    }
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    public function getJWTCustomClaims(){
        return [];
    }
}