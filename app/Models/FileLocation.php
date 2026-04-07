<?php
namespace App\Models;
use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Model;
class FileLocation extends Model {
    use ApiTrait;
    protected $table = 'file_locations';
    public $timestamps = false;
    protected $fillable = [
        'file_location_code',
        'name',
        'description',
    ];
    public function caseFiles(){
        return $this->hasMany(CaseFile::class, 'location_id');
    }
}