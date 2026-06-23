<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'semester',
        'batch',
        'course',
        'year',
        'user_id',
    ];

    /**
     * Get the user account linked to this student.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the fee records for this student.
     */
    public function fees()
    {
        return $this->hasMany(Fee::class);
    }
}
