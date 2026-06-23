<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'description',
        'total_fee',
        'fee_paid',
        'due_date',
    ];

    protected $casts = [
        'total_fee' => 'decimal:2',
        'fee_paid' => 'decimal:2',
        'due_date' => 'date',
    ];

    /**
     * Get the student this fee belongs to.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Computed: Fee Remaining = Total Fee - Fee Paid.
     */
    public function getFeeRemainingAttribute()
    {
        return $this->total_fee - $this->fee_paid;
    }

    /**
     * Computed: Status based on payment progress.
     */
    public function getStatusAttribute()
    {
        if ($this->fee_paid >= $this->total_fee) {
            return 'Paid';
        } elseif ($this->fee_paid > 0) {
            return 'Partial';
        }
        return 'Unpaid';
    }
}
