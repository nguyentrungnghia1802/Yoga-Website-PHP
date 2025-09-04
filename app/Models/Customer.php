<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name','phone','email','birthday','gender','address','note'
    ];

    protected $casts = [
        'birthday' => 'date',
    ];

    public function registrations() {
        return $this->hasMany(Registration::class);
    }
}
