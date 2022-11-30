## Charts

This is a simple project showing data through charts. You can use this to visualize data on your admin panel or wherever you might need to.
This particular project uses [chart.js](https://www.chartjs.org/docs/latest/) and laravel [livewire](https://laravel-livewire.com/)

## Getting Started
Rename `.env.example` file to `.env` inside your project.This will enable all the nesessary database information.Feel free to change database information as needed. Open the console and `cd` into your project root directory.

* Run `composer install` to install necesary files
* Run `php artisan key:generate` to generate a unique app key.
* Run `php artisan migrate:fresh --seed`.This will migrate all the necessary database tables and seed the database with fake data to give you a more realistic visual preview of what the project is about.
* To have a fresh install without the fake data run `php artisan migrate:fresh`.This will install a fresh, empty version of the app.
* Run `php artisan serve` to boot up the app.

#### Any outside help or ideas are more than welcome.
