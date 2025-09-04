<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clazz extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'classes';

    protected $fillable = [
        'teacher_id','name','lich_hoc','start_time','end_time',
        'start_date','end_date','quantity','price','location','description'
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time'   => 'datetime:H:i',
        'start_date' => 'date',
        'end_date'   => 'date',
        'quantity'   => 'integer',
        'price'      => 'decimal:2',
    ];

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function registrations() {
        return $this->hasMany(Registration::class, 'class_id');
    }
}
