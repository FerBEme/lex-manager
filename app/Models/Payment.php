<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Payment extends Model {
    use HasFactory;
    protected $table = 'payments';
    public $timestamps = false;
    protected $fillable = [
        'type',
        'amount',
        'status',
        'description',
        'case_file_id',
    ];
    protected $casts = [
        'created_at' => 'datetime'
    ];
    public function caseFile(){
        return $this->belongsTo(CaseFile::class,'case_file_id');
    }
    public function receipts(){
        return $this->hasMany(Receipt::class,'payment_id');
    }
}
