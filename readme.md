# About Purchase Orders

Purchase Orders is a web based application that allows users in a small business environment to create and manage purchase orders with the existing ERP. A purchase order is a commercial document and first official offer issued by a buyer to a seller indicating types, quantities, and agreed prices for products or services. It is used to control the purchasing of products and services from external suppliers.[1] Purchase orders can be an essential part of enterprise resource planning system orders.

## Setup on local machine

I have used homestead environment to develop this application. If you would like to run this app on your local development server, you must install NPM and PHP Composer to build the project.

Once you have installed NPM and Composer, cd into the project directory, and run 'composer install' to get PHP dependencies and 'npm install' and then 'npm run dev' to build this project.

Once installed and built, you need to create database and configure it in .env file. You can access the project at http://localhost:8080. As the client does not currently have a user creation endpoint, 'php artisan migrate:fresh --seed' to migrate database tables and seed the database with demo users and data.

## Used technology
- HTML5
- CSS3
- JavaScript
- PHP 7.1.3
- MySql
- jquery 3.2
- Laravel 5.8

## PHP depedencies
- php: ^7.1.3
- fideloper/proxy: ^4.0
- kyslik/column-sortable: ^5.8
- laravel/framework: 5.8.*
- laravel/tinker: ^1.0
- beyondcode/laravel-dump-server: ^1.0
- filp/whoops: ^2.0
- fzaninotto/faker: ^1.4
- mockery/mockery: ^1.0
- nunomaduro/collision: ^3.0
- phpunit/phpunit: ^7.5

## JavaScript depedencies
- axios: ^0.18
- bootstrap: ^4.3.1
- cross-env: ^5.1
- jquery: ^3.2
- laravel-mix: ^4.0.7
- lodash: ^4.17.5
- popper.js: ^1.12
- resolve-url-loader: ^2.3.1
- sass: ^1.15.2
- sass-loader: ^7.1.0
- vue: ^2.6.10
- vue-template-compiler: ^2.6.10
- bootstrap-vue: ^2.0.0-rc.25
- cxlt-vue2-toastr: ^1.1.0
- laravel-vue-pagination: ^2.3.0,
- router: ^1.3.3
- vee-validate: ^2.2.12
- vue-router: ^3.0.6
- vue-select: ^3.1.0
- vue-toasted: ^1.1.27
- vuex: ^3.1.1


## Build tool
- PNM - Package Manager
- webpack - Module Bundler
- git - Source Control

## Author
- Ramesh Kumar (inforkgodara)

## Screenshots

### Login purchase orders
![login purchase orders](https://raw.github.com/inforkgodara/purchase-orders/master/screenshots/1-login-purchase-orders.png?raw=true "login")

### Branch module list view
![list of branch module](https://raw.github.com/inforkgodara/purchase-orders/master/screenshots/2-branch-module-list-view.png?raw=true "list view")

### Order creation
![order creation](https://raw.github.com/inforkgodara/purchase-orders/master/screenshots/3-order-creation.png?raw=true "purchase order creation")

### Creditor creation
![creditor creation](https://raw.github.com/inforkgodara/purchase-orders/master/screenshots/4-creditor-creation.png?raw=true "creditor creation")