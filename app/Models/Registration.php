<?php
namespace App\Models;

use App\Enums\RegistrationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'customer_id','class_id','package_months','discount','final_price','status','note'
    ];

    protected $casts = [
        'package_months' => 'integer',
        'discount'       => 'decimal:2',
        'final_price'    => 'decimal:2',
        'status'         => RegistrationStatus::class,
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function class() {
        return $this->belongsTo(Clazz::class, 'class_id');
    }
}
