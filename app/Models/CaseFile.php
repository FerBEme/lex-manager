<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CaseFile extends Model {
    protected $table = 'case_files';
    protected $fillable = [
        'file_number',
        'jurisdictional_body',
        'judicial_district',
        'judge',
        'legal_specialist',
        'start_date',
        'process',
        'subject',
        'completion_date',
        'reason_conclusion',
        'specialty_id',
        'status_id',
        'location_id',
        'lawyer_id',
        'customer_id',
    ];
    protected function casts(): array {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'start_date' => 'date',
            'completion_date' => 'date',
            'specialty_id' => 'integer',
            'status_id' => 'integer',
            'location_id' => 'integer',
            'lawyer_id' => 'integer',
            'customer_id' => 'integer',
        ];
    }
    public function specialty(){
        return $this->belongsTo(Specialty::class,'specialty_id');
    }
    public function status(){
        return $this->belongsTo(FileStatus::class, 'status_id');
    }
    public function location(){
        return $this->belongsTo(FileLocation::class, 'location_id');
    }
    public function lawyer(){
        return $this->belongsTo(User::class, 'lawyer_id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function folders(){
        return $this->hasMany(Folder::class,'case_file_id');
    }
    public function events(){
        return $this->hasMany(Event::class,'case_file_id');
    }
    public function payments(){
        return $this->hasMany(Payment::class,'case_file_id');
    }
}
