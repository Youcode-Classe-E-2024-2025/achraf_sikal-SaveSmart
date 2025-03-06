<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transactions";
    protected $fillable = ['type','user_id', 'profile_id', 'category_id', 'amount', 'date', 'description'];

    /**
     * Get the users that belong to the family.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function profile()
    {
        return $this->belongsTo(Profiles::class);
    }
}
