<?php
namespace App\Models;
use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class CaseFile extends Model {
    use HasFactory,ApiTrait;
    protected $fillable = [
        'case_number',
        'judicial_body',
        'judicial_district',
        'judge',
        'legal_specialist',
        'start_date',
        'process_type',
        'specialty',
        'subject',
        'status',
        'procedural_stage',
        'end_date',
        'conclusion_reason',
        'location',
        'summary',
        'customer_id',
        'lawyer_id',
    ];
    protected $casts = [
        'id'          => 'integer',
        'start_date'  => 'datetime',
        'end_date'    => 'datetime',
        'customer_id' => 'integer',
        'lawyer_id'   => 'integer',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function lawyer(){
        return $this->belongsTo(User::class,'lawyer_id');
    }
    public function folders(){
        return $this->hasMany(Folder::class,'case_id');
    }
    public function events(){
        return $this->hasMany(Event::class,'case_id');
    }
}