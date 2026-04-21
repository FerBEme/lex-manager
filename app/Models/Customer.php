<?php
namespace App\Models;
use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Customer extends Model {
    use HasFactory,ApiTrait;
    protected $fillable = [
        'document_type',
        'nro_document',
        'company_name',
        'first_name',
        'paternal_name',
        'maternal_name',
        'phone',
        'email',
        'address',
    ];
    protected $casts = [
        'id'         => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function caseFiles(){
        return $this->hasMany(CaseFile::class,'customer_id');
    }
    public function eventParticipants(){
        return $this->hasMany(EventParticipant::class,'customer_id');
    }
}