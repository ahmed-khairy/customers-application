<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Product extends Model
{ 
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'title',
        'description',
        'images',
        'cost',
        'wholeSaleCose',
        'height',
        'width',
        'length',
        'weight',
        'customer_id'
    ];
 
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
}
