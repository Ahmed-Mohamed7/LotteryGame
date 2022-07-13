<?php

namespace Tests\Unit;

use App\Models\Box;
use App\Models\User;
use App\Services\BoxService;
use Tests\TestCase;

class BoxTest extends TestCase
{
     /**
     * check the validation of get all boxes
     * Enter 
     *
     * @return void
     */
    /** @test */
    public function test_GetAllBoxes()
    {
        $box = (new BoxService())->GetAllBoxes();
        $this->assertNotNull($box);
    }

     /**
     * check the create of boxes
     * Enter 
     *
     * @return void
     */
    /** @test */
    public function test_CreateBox()
    {
        $adminID = User::where('admin',true)->first()->id;
        $box = (new BoxService())->CreateBox($adminID);
        $this->assertNotNull($box);
    }


    /**
     * check get the info specific box
     * Enter 
     *
     * @return void
     */
    /** @test */
    public function test_GetBoxInfo()
    {
        $boxID = Box::first()->id;
        $box = (new BoxService())->GetBoxInfo($boxID);
        $this->assertNotNull($box);
    }

    /**
     * check get the info specific box
     * Enter 
     *
     * @return void
     */
    /** @test */
    public function test_GetBoxPrice()
    {
        $boxID = Box::first()->id;
        $price = (new BoxService())->GetBoxPrice($boxID);
        $this->assertIsNumeric($price);
    }


}
