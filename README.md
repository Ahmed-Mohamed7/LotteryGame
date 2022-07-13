<div align="center"><h1> Lottery Game Backend </h1></div>


## Table Content
- [About]
- [Technologies and Tools used]
- [Database Schema](#Database-Schema)
- [Get Start]
- [Functionalities Implemented]

## About
This is a lottery game where the players buy boxes.
The winner receives 10% of ALL the boxes sold.
The admin creates a number of boxes, each box has a list of random items. Item's attributes are Name, Image, Description and Price.
All items prices in the box summed up plus 10% equal the price of the box.
Example of Items: Voucher worth 0.0096 ETH, iPhone worth 0.000048 ETH, A laptop worth 2.39 ETH, etc.
Example of a box: Voucher worth 0.0016 ETH, a mobile worth 0.000064 ETH
This Box is sold for 0.0096 + 0.000064 + 10% (0.0009664) = 0.0106304 ETH
The box's ownership acts like a smart contract. The ownership is the admin's until any user buys it, The ownership is transferred to the user.
Players can register using First Name, Last Name, Mobile number, Email and Gender.
Players can only buy the boxes using Ethereum.
The admin clicks a button which randomly chooses one of the people who bought a box. The winner's money is calculated automatically.


## Technologies and Tools used
- PHP and Laravel8 framework.
- API documentation was Generated using postman
- Complete requests collection was constructed using postman.
- PostgreSQL as DataBase Solutioin using the concepts of migration and seeding.
- Unit testing was written using PHPUnit.
- Laravel Sanctum for OAuth authentication
- Composer.

## Er Diagram
https://drawsql.app/cairo-university-5/diagrams/lottery-game

# Get Start
To run the project locally on your pc:
```
git clone https://https://github.com/Ahmed-Mohamed7/LotteryGame.git
cd LotteryGame
```
```
composer install
```
- Migrate and seed the database, by running the following command:
```
php artisan migrate –seed
```
- Start the backend server that handles the application requests by running the following command: 
```
php artisan serve
```
- Start vue front end
```
   cd vue
   npm install
   npm run dev
```


## Functionalities Implemented
### User Module
- User Register
- User Login
- User Logout
- Get User by ID
- Get Boxes bought by User
- User Buy Action
- User Profile
- Admin Select Winner

### Box Module
- CRUD system Index , Create , delete , show , edit , update Boxes

### Item Module
- CRUD system Index , Create , delete , show , edit , update Items
- Upload images of items

### BoxItems Module
- Insert specific item in specific Box
- remove specific item from specific Box
