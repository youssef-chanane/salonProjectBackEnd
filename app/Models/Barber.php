<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Barber extends Model
{
    use HasFactory,HasApiTokens,Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'years_exp',
        'is_availible',
        'user_id'
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
