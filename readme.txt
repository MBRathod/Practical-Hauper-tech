setup project task step

php 8

composer install

Use your email credantial in ENV file

composer create-project laravel/laravel="9.*" hauperTechnologies

composer require laravel/ui

php artisan ui bootstrap

npm install && npm run dev

php artisan migrate

php artisan db:seeds

To create a command 

--- php artisan make:command UserReminder

set the signature of the command

--- protected $signature = 'users:user-reminder';

So now we can run this command in our terminal

-- php artisan users:user-reminder

Inside the handle() method write all the business logic for the notification

this command for email notification check

php artisan schedule:work


Description Of all Task

I have created bootstrap auth login register.
I have created migration for database schema
I have created seeder for testing.
I have used SOLID Principal for coding standard.
I have created Reminders Crud after login
I have created ajax delete function
I have used jquery datatable for data listing