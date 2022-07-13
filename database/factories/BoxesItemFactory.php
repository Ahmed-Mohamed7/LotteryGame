<?php

namespace Database\Factories;

use App\Models\BoxesItem;
use App\Models\Items;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Items>
 */
class BoxesItemFactory extends Factory
{
    protected $id = 1;
    protected $iter=0;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $boxId = $this->id;
        $this->iter +=1;
        if($this->iter %3 == 0)
            $boxId = $this->id++;
        $item = Items::inRandomOrder()->first();
        return [
            'box_id' => $boxId,
            'items_id' => $item->id,
            'quanlity' => 1,
            'price' => $item->Price
        ];
    }
}
