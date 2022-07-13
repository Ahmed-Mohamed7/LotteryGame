<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoxesItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'box_id',
        'items_id',
        'quanlity',
        'price',
    ];
}
