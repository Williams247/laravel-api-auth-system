<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens;

    # Mass assignable fields
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    # Recommended for password hashing
    protected $casts = [
        'password' => 'hashed',
    ];

    # Relationship to notes
    public function notes()
    {
        return $this->hasMany(Notes::class);
    }
}

?>
