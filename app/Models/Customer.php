<?php
namespace App\Models;
use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Customer extends Model {
    use HasFactory,ApiTrait;
    protected $table = 'customers';
    protected $fillable = [
        'document_type',
        'document_number',
        'company_name',
        'names',
        'paternal_surname',
        'maternal_surname',
        'email',
        'phone',
        'home_address',
    ];
    protected function casts(): array {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
