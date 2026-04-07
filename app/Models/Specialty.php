<?php
namespace App\Models;
use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Model;
class Specialty extends Model {
    use ApiTrait;
    protected $table = 'specialties';
    public $timestamps = false;
    protected $fillable = [
        'specialty_code',
        'name',
        'description',
    ];    
    public function lawyers(){
        return $this->belongsToMany(
            User::class,
            'lawyer_specialty',
            'specialty_id',
            'lawyer_id'
        );
    }
    public function caseFiles(){
        return $this->hasMany(CaseFile::class, 'specialty_id');
    }
}