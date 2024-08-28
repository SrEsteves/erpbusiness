<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Definindo os campos que podem ser preenchidos
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    // Relacionamento com a model Order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
