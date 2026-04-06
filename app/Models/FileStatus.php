<?php
namespace App\Models;
use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Model;
class FileStatus extends Model {
    use ApiTrait;
    protected $table = 'file_statuses';
    public $timestamps = false;
    protected $fillable = [
        'file_status_code',
        'description',
    ];
}