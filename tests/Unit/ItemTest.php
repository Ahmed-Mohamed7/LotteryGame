<?php

namespace Tests\Unit;

use App\Http\Requests\ItemsRequest;
use App\Services\ItemService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;


class ItemTest extends TestCase
{

    use WithFaker;
    protected static $initialized = FALSE;
    protected static $data;
    /**
     * test user settings
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->rules     = (new ItemsRequest())->rules();
        $this->validator = $this->app['validator'];
        $this->setUpFaker();
    }

    /**
     * check the validation of validateNames and Description of items
     * Enter 
     *
     * @return void
     */
    /** @test */
    public function validateNamesandDescription()
    {
        //Names and Description cannot be:

        // empty
        $this->assertFalse($this->validateField('Name', ''));
        $this->assertFalse($this->validateField('Description', ''));
        //max:255 char
        $this->assertFalse($this->validateField('Name', Str::random(300)));
        $this->assertFalse($this->validateField('Description', Str::random(300)));


        // correct Names and Description
        $this->assertTrue($this->validateField('Name', 'ahmed'));
        $this->assertTrue($this->validateField('Description', 'mohamed'));
    }

    /**
     * check the validation of validateNames and Description of items
     * Enter 
     *
     * @return void
     */
    /** @test */
    public function validatePrice()
    {
        //Names and Description cannot be:

        // empty
        $this->assertFalse($this->validateField('Price', ''));
        //string
        $this->assertFalse($this->validateField('Price', 'aa'));

        //betweeen 0:100000
        $this->assertFalse($this->validateField('Price', -5));
        $this->assertFalse($this->validateField('Price', 1000000000));


        // correct Price
        $this->assertTrue($this->validateField('Price', 1000));
    }

      /**
     * check the validation of get all items
     * Enter 
     *
     * @return void
     */
    /** @test */
    public function test_GetAllBoxes()
    {
        $item = (new ItemService())->GetAllItems();
        $this->assertNotNull($item);
    }

      /**
     * check the validation of store image
     * Enter 
     *
     * @return void
     */
    /** @test */
    public function test_CreateItem()
    {
        $box = (new ItemService())->CreateItem([
            'Name'=> $this->faker->name(),
            'Description' =>$this->faker->text(),
            'Price'=>$this->faker->randomFloat(),
        ],time());
        $this->assertNotNull($box);
    }
    
     /**
     * check the validation of store image
     * Enter 
     *
     * @return void
     */
    /** @test */
    public function test_GetBoxItem()
    {
        $validatedData['box_id'] = 1;
        $validatedData['items_id'] = 1;

        $item = (new ItemService())->GetBoxItem($validatedData);
        $this->assertNotNull($item);
    }
    




    protected function getFieldValidator($field, $value)
    {
        return $this->validator->make(
            [$field => $value],
            [$field => $this->rules[$field]]
        );
    }

    protected function validateField($field, $value)
    {
        return $this->getFieldValidator($field, $value)->passes();
    }
}
