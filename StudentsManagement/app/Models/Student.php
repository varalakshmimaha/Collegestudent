<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    protected $casts = [
        'joining_date' => 'date',
        'after_placement_fee' => 'boolean',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Total amount paid (computed from payments table, never stored).
     */
    public function getPaidAmountAttribute()
    {
        return $this->payments()->sum('amount');
    }

    /**
     * Total contractual fee = training_fee + placement_fee (always shown).
     */
    public function getTotalContractAttribute()
    {
        return ($this->training_fee ?? 0) + ($this->after_placement_amount ?? 0);
    }

    /**
     * Payable Now (amount due based on new fee structure):
     *   Uses final_fee which is: total_fee (tuition + admission + optional) - discount
     */
    public function getPayableNowAttribute()
    {
        return $this->final_fee ?? 0;
    }

    /**
     * Balance due: what's still owed (never negative).
     */
    public function getBalanceAttribute()
    {
        return max(0, $this->payable_now - $this->paid_amount);
    }

    /**
     * Credit / advance: overpayment before placement fee kicks in.
     */
    public function getCreditAttribute()
    {
        return max(0, $this->paid_amount - $this->payable_now);
    }
}
