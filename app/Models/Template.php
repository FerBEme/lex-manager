<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Template extends Model {
    use HasFactory;
    protected $table = 'templates';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'content',
        'logo_path',
        'created_by',
    ];
    protected $casts = [
        'created_by' => 'integer',
        'created_at' => 'datetime'
    ];
    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }
}
