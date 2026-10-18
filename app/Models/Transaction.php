<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = [
        'user_id', 'category_id', 'amount', 'type',
        'date', 'description', 'payment_method', 'note',
    ];

    // Relasi ke tabel categories
    public function category()
    {
        return $this -> belongsTo(Category::class, 'category_id');
    }
}
