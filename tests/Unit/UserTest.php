<?php

namespace Tests\Unit;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\Auth\RegisterService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserTest extends TestCase
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
        $this->rules     = (new RegisterRequest())->rules();
        // $this->Login_rules = (new LoginRequest())->rules();
        $this->validator = $this->app['validator'];
        $this->setUpFaker();
    }

    // test validations
    /**
     * check the validation of email in users
     * Enter 
     *
     * @return void
     */
    /** @test */
    public function validateEmail()
    {
        //email cannot be:

        // invalid syntax
        $this->assertFalse($this->validateField('email', 'this is the content of the post'));
        $this->assertFalse($this->validateField('email', '@#A$#askd1x 123__'));
        //empty
        $this->assertFalse($this->validateField('email', ''));
        //already existing 
        $email = User::first()->email;
        $this->assertFalse($this->validateField('email', $email));

        // correct email
        $this->assertTrue($this->validateField('email', 'unique_email@gmail.com'));
    }

    /**
     * check the validation of Names in users
     * Enter 
     *
     * @return void
     */
    /** @test */
    public function validateNames()
    {
        //Names cannot be:

        // empty
        $this->assertFalse($this->validateField('firstName', ''));
        $this->assertFalse($this->validateField('lastName', ''));
        //max:255 char
        $this->assertFalse($this->validateField('firstName', Str::random(300)));

        // correct Names
        $this->assertTrue($this->validateField('firstName', 'ahmed'));
        $this->assertTrue($this->validateField('lastName', 'mohamed'));
    }

    /**
     * check the validation of Password in users
     * Enter 
     *
     * @return void
     */
    /** @test */
    public function validatePassword()
    {
        //Password cannot be:

        // empty
        $this->assertFalse($this->validateField('password', ''));
        // less than 8 characters
        $this->assertFalse($this->validateField('password', 'Ahmed'));
        // contain only lower case
        $this->assertFalse($this->validateField('password', 'ahmed123'));
        // don't have symbol
        $this->assertFalse($this->validateField('password', 'Ahmed123'));
        //don't contains numbers
        $this->assertFalse($this->validateField('password', 'ahmedaaa'));


        //correct password
        $this->assertTrue($this->validateField('password', 'Ahmed_123'));
        $this->assertTrue($this->validateField('lastName', 'Ahmed_M55'));
    }

    /**
     * check the validation of other attributes in users
     * Enter 
     *
     * @return void
     */
    /** @test */
    public function validateOtherAtts()
    {
        //Gender cannot be:

        // empty
        $this->assertFalse($this->validateField('Gender', ''));
        // string other than male or female
        $this->assertFalse($this->validateField('Gender', 'differentWord'));

        // correct Gender
        $this->assertTrue($this->validateField('Gender', 'male'));
        $this->assertTrue($this->validateField('Gender', 'female'));


        //Mobile number cannot be
        //contain letters
        $this->assertFalse($this->validateField('mobileNumber', 'ahmed'));
        //empty
        $this->assertFalse($this->validateField('mobileNumber', ''));

        //correct Mobile number
        $this->assertTrue($this->validateField('mobileNumber', '01127010091'));
    }

    /**
     * check the creation of users
     * Enter 
     *
     * @return void
     */
    /** @test */
    public function Test_CreateUser()
    {
        // dd($this->faker->email);
        $user = (new RegisterService())->CreateUser(
            [
                "email" => $this->faker->unique()->safeEmail(),
                'firstName' => $this->faker->name(),
                'lastName' => $this->faker->name(),
                'password' => Hash::make('Ahmed_123'),
                'mobileNumber' => $this->faker->phoneNumber(),
                'Gender' => $this->faker->randomElement(['male', 'female'])
            ]
        );
        $this->assertNotNull($user);
    }

     /**
     * check the creation of user token
     * Enter 
     *
     * @return void
     */
    /** @test */
    public function Test_CreateToken(){
        $user = User::first();
        $token = (new RegisterService())->CreateToken($user);
        $this->assertNotNull($token);
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
