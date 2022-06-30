<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
 
class Marketer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'profile_image',
        'available_balance',
        'code',
    ];
    protected $hidden = [
        'password',
    ];
    public function customers()
    {
        return $this->hasMany(Customer::class);
    } 
}
