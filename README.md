# Accounting App

The application, for issuing and cataloging invoices, which can be useful for homogeneous businesses and B2B employees who issue invoices of similar content every month.

## Features

-   Login and registration.
-   Issuing an invoice.
-   Ability to edit or delete an invoice.
-   Ability to download an invoice as a .pdf file.
-   Prepared layout for printing an invoice from within the application (shortcut ctr + p).
-   Ability to set default custom data, which will be automatically suggested when creating a new invoice.
-   Ability to set your company logo, which will appear on each generated invoice.
-   Ability to set user avatar.

**In the future, the project will be expanded to include:**

-   Ability to send an invoice in an email (as a .pdf file).
-   Dashboard displaying a summary of all invoices issued by the user.
-   Home page available for non-logged-in users (index.php).

## Libraries

-   **dompdf**\
    Responsible for generating pdf files.

## Interesting scripts

_This section contains a description of the more difficult scripts I have come to write._

### JavaScript

-   A function that takes a number and returns its verbal notation.

### PHP

-   A script that automatically suggests a new invoice number. Retrieves information about all set invoices from the database and suggests a no. which is consecutive, unique, contains information about month and year of invoice issuance.

## How to run

To run the application you need:

1. Have XAMPP installed with support for Apache server and MySQL databases.
2. Enable GD (Graphics library).
3. Download the application folder to your computer.
4. Import database I have prepared for you.

### 1. Install XAMPP

-   Install XAMPP for your operating system\
    You can download the program [at this site](https://www.apachefriends.org/pl/index.html). Detailed installation instructions are described on [YouTube](https://youtu.be/WSeKPbVZBoo?t=183).
-   Start XAMPP and launch APACHE and MySQL.
-   Locate the `htdocs` folder that was created with the installation of XAMPP By default, it is located in the newly created xampp folder. (Example path on windows: `c:\xampp\htdocs\`.)

### 2. Enable GD library

In fact, in order for the DOMPDF library to work properly, it is necessary to enable the GD library. To do this, remove `;` in the `php.ini` file and change the `;extension=gd` line to `extension=gd`. [Read more](https://reporter.pl/php-jak-uaktywnic-biblioteke-graficzna-gd-w-php-pod-windows-143).

> The `php.ini` file should be located in the `htdocs` folder.\
> Example location `c:\xampp\htdocs\php.ini`

### 3. Download project

_You can download the project in two ways. The first way is to traditionally download the files to your computer (A). You can also download the project directly using the command line in the terminal (B)._

#### A) Download the zip files

-   Download the files from github to your computer. Click on the `<> Code` button and then `Download ZI P`.
-   Unzip the archive. In the archive there is a folder with the application. It should be called `Accounting-App-main`, but in your case it may be called something else.
-   Move the above folder to the `htdocs` folder Example destination path (Windows): `C:`htdocs` `Accounting-App-main`.

#### B) Download using the terminal

-   In the terminal, move to the `htdocs` folder.
-   Type the command `git clone https://github.com/ferenskamil/Accounting-App.git`.\
    The repository should be downloaded to the `htdocs` folder.

### 4. Import SQL database

-   Download the file from the app folder in location `assets\sql\accounting_app.sql`.
-   Then type `http://localhost/phpmyadmin/index.php` into your browser.

> Now you should find yourself in the phpMyAdmin panel

##### Import the database file

1. create a new database named `accounting app`. From the phpMyAdmin level, click on `New`. Enter the name `accounting app`. Select `utf8mb4_polish_ci` as the encoding system.
   2 Go to `Import` tab, then select `upload file` and upload the `accounting_app.sql` file.\
   The `accounting_app.sql` file is located in the `assets\sql\accounting_app.sql` folder.
2. Click the `import` button.

> At this point you should see messages indicating that the database has been imported correctly. In your `accounting app` database you should also see the `users`, `services`, `invoices` tables filled in.

### Now you can use the application

1. Make sure XAMPP is enabled (point 1)
2. In your browser, type `http://localhost/accountingApp-main/index.php`.\
   At this point you should find yourself on the application's home page. The home page is not quite built yet, but you can log in to test the application.
3. log in to the application

_To log in you can create a new account or log in with the following details:_\
_**login:** testUser_\
_**password:** qwerty1234_

> Note: The data you enter into database will be exclusively on your computer and will not be shared.

Thank you for your interest in my application. I hope you will enjoy using it.
Kamil :)
