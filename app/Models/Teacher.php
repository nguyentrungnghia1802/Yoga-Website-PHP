<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name','phone','email','birthday','exp_year','description','avatar'
    ];

    protected $casts = [
        'birthday' => 'date',
        'exp_year' => 'integer',
    ];

    public function classes() {
        return $this->hasMany(YogaClass::class, 'teacher_id');
    }
}
