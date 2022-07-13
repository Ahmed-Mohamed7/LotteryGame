<?php

namespace App\Models;
use App\Models\Box;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Name',
        'Image',
        'Description',
        'Price',
    ];

    public function box()
    {
        return $this->belongsToMany(Box::class);
    }
}
