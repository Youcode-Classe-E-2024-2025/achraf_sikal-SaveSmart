<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class budgetOpt extends Model
{
    use HasFactory;

    protected $table = 'budget_optimizations';

    protected $fillable = ['income', 'needs', 'wants', 'savings', 'date', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
