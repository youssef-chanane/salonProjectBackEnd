<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
        /**
     * Get the user that owns the phone.
     */
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
