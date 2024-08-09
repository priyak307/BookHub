# BookHub - E-Library Platform

## Table of Contents

- [Introduction](#introduction)
- [Preview](#preview)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Usage](#usage)

## Introduction

**BookHub** is a robust e-library platform designed to simplify and streamline library operations. It includes features for both users and admins, such as book requests, issuance, and fine calculations. The platform is designed with security and usability in mind, offering a seamless experience for managing library accounts and book collections.

### Preview

Here is a preview video showcasing the main features of BookHub,
<p align="center">
  <img src="https://github.com/priyak307/BookHub/blob/master/images/preview-video.gif" alt="Screenshot 1"/>
</p>

## Features

- **User Login & Registration**: Secure user authentication and account creation.
- **Admin Login**: Admin panel for managing books, users, and transactions.
- **Book Management**: Add, update, delete, and search for books.
- **Book Requests & Issuance**: Users can request books, and admins can manage issuance.
- **Fine Calculation**: Automated calculation of fines for overdue books.
- **Dashboard**: Intuitive dashboard for easy navigation and management.

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Security**: PDO (PHP Data Objects) for secure database connectivity
- **Server**: Hosted on XAMPP

## Installation

### Prerequisites

- XAMPP or any other local server environment
- Web browser

### Steps

1. **Clone the repository**:
   ```bash
   git clone https://github.com/priyak307/BookHub.git
2. **Set Up the Database**:
   - Open phpMyAdmin and create a new database named `library_management`.
   - Import the provided SQL file (`library_management.sql`) into the database.
3. **Configure the project**:
   - Navigate to the project directory and place it inside the `htdocs` folder of XAMPP.
   - Open the project and configure the database connection in the `db.php` file.
   ```php
   <?php
    class db{
    protected $connection;
    function setconnection(){
      try{
        $this->connection=new PDO("mysql:host=localhost; dbname=library_managment","root","");
        echo "Done";
    }catch(PDOException $e){
        echo "Error";
    }
    }
    }
4. **Start the Server**:
   - Launch XAMPP and start the Apache and MySQL services.
   - Open a web browser and go to `http://localhost/BookHub` to access the platform.

### Usage

- **Admin Panel:** Log in with admin credentials to access the dashboard and manage books and users.
- **User Features:** Users can browse books, request for books, view borrowed books, and track fines.
