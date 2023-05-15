<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> - </title>
    </head>
    <body>
        <h1>Laravel Point of Sale (POS)</h1>
        <p>This is a Point of Sale (POS) system built using Laravel. The system includes features for managing employees, salaries, expenses, products, and customers.</p>
        <h2>Requirements</h2>
        <p>To run this application, you will need:</p>
        <ul>
            <li>PHP version 7.2.5 or newer</li>
            <li>Laravel version 7.0 or newer</li>
            <li>The following dependencies:
                <ul>
                    <li>barryvdh/laravel-dompdf: ^2.0</li>
                    <li>fideloper/proxy: ^4.2</li>
                    <li>fruitcake/laravel-cors: ^1.0</li>
                    <li>guzzlehttp/guzzle: ^6.3</li>
                    <li>intervention/image: ^2.7</li>
                    <li>laravel/framework: ^7.0</li>
                    <li>laravel/tinker: ^2.0</li>
                    <li>laravel/ui: ^2.4</li>
                    <li>realrashid/sweet-alert: ^6.0</li>
                    <li>spatie/laravel-permission: ^5.10</li>
                </ul>
            </li>
        </ul>
        <h2>Installation</h2>
        <p>To install and run this application, follow these steps:</p>
        <ol>
            <li>Clone this repository to your local machine.</li>
            <li>Install the dependencies using <code>composer install</code>.</li>
            <li>Create a new database for the application.</li>
            <li>Rename the <code>.env.example</code> file to <code>.env</code> and update it with your database credentials.</li>
            <li>Run the command <code>php artisan key:generate</code> to generate an application key.</li>
            <li>Run the command <code>php artisan migrate</code> to create the required tables in the database.</li>
            <li>Seed the database with initial data using the command <code>php artisan db:seed</code>.</li>
            <li>Run the command <code>php artisan serve</code> to start the application.</li>
        </ol>
        <h2>Usage</h2>
        <p>Once the application is running, you can access it by visiting <code>http://localhost:8000</code> in your web browser.</p>
        <p>The system includes features for managing employees, salaries, expenses, products, and customers. You can access these features via the sidebar navigation menu.</p>
        <h2>Contributing</h2>
        <p>If you would like to contribute to this project, you are welcome to submit a pull request. Please make sure to include a detailed description of the changes you are proposing.</p>
        <h2>License</h2>
        <p>This project is licensed under the MIT License. See the <code>LICENSE</code> file for more information.</p>
    </body>
</html>
