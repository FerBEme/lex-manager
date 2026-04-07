<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Receipt extends Model {
    use HasFactory;
    protected $table = 'receipts';
    public $timestamps = false;
    protected $fillable = [
        'receipt_number',
        'file_path',
        'payment_id',
        'customer_id',
    ];
    protected $casts = [
        'payment_id' => 'integer',
        'customer_id' => 'integer',
        'created_at' => 'datetime',
    ];
    public function payment(){
        return $this->belongsTo(Payment::class,'payment_id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
