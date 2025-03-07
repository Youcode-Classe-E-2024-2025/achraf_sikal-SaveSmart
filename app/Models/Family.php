<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $table = 'families';

    protected $fillable = ['name'];

    /**
     * Get the users that belong to the family.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
