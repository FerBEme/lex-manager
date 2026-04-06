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
        'description',
    ];
}
