<?php

namespace App\Models;
use App\Models\Items;
use App\Models\boxItems;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sold',
        'owner_id',
    ];

    public function item()
    {
        return $this->belongsToMany(Items::class,'boxes_items');
    }

    public function boxItems()
    {
        return $this->hasMany(boxItems::class,'box_id');
    }
}
