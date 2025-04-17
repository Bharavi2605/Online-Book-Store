# 📚 Online Bookstore Website

This is a dynamic online bookstore developed using **HTML**, **CSS**, **PHP**, **MySQL**, and **JavaScript**. The website allows users to explore and purchase physical books across multiple genres. It includes full user and admin functionality such as authentication, book management, and order processing.

---

## 🧾 Project Abstract

The Online Bookstore aims to create a user-friendly platform where book lovers can easily explore, select, and purchase books. Users can browse through categorized books, add them to their cart, and complete purchases using various payment methods. Meanwhile, administrators can manage book listings, view orders, and maintain the system. The site is responsive, secure, and designed for scalability. Future upgrades may include options for downloading books, user reviews, and personalized recommendations.

---

## ✨ Features

### User Module
- Sign up and login
- Browse books by genre
- View detailed book information with images
- Add to cart and update quantities
- Checkout with address and payment details
- Place and confirm orders

### Admin Module
- Secure admin login
- Add, edit, and delete book listings
- Upload cover images for books
- View and manage all customer orders

---

## 🗃️ Modules

1. **User Authentication** – Sign up, login, and logout.
2. **Book Browsing** – Users can explore books by genre.
3. **Shopping Cart** – Add books, update quantities, remove items.
4. **Order Placement** – Checkout and store user details and orders.
5. **Order Management (Admin)** – Admin can view all orders placed.
6. **Book Management (Admin)** – Add/edit/delete books with cover images.

---

## 🏗️ Project Structure
bookstore/ │ 
├── add_book.php # Admin adds books 
├── books.php # Display books to users 
├── cart.php # User cart handling 
├── checkout.php # Checkout process 
├── database.php # MySQL DB connection 
├── delete_book.php # Admin deletes book 
├── edit_book.php # Admin edits book details 
├── index.php # Homepage / login redirect 
├── login.php # User login 
├── logout.php # User logout 
├── manage_books.php # Admin view/edit/delete books 
├── manage_orders.php # Admin views customer orders 
├── order_success.php # Order confirmation page 
├── signup.php # New user registration 
├── uploads/ # Folder for cover images 
├── styles_books.css # Book listings CSS 
├── styles_checkout.css # Checkout page CSS 
├── styles_success.css # Order success CSS 

---

## 🛠️ Technologies Used

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL (via phpMyAdmin)
- **Server:** XAMPP / Apache


---

## Installation Steps
1.Download or Clone the Repository
just download the ZIP file and extract it.

2.Move the Project to XAMPP Directory
Move the folder to C:\xampp\htdocs\ (Windows)
Example path: C:\xampp\htdocs\online-bookstore\

3.Start Apache and MySQL
Open XAMPP Control Panel.
Click Start for both Apache and MySQL.

4.Create the Database
Open http://localhost/phpmyadmin
Create a database named bookstoredb
Import the SQL file:
Click Import
Choose databasecode (provided with the project)
Click Go

5.Update Database Configuration (Optional)
Open database.php
Make sure the database credentials match your setup:

$host = "localhost";
$user = "root";
$password = "";
$database = "bookstore";


---

## Usage
1.Access the Website
Visit http://localhost/online-bookstore in your browser.

2.As a New User
Register using signup.php
Login and browse books, add to cart, and place an order.

3.As Admin
   Login using the admin credentials (e.g., admin@example.com, password: admin123)
   Access:
      manage_books.php to add/edit/delete books
      manage_orders.php to view customer orders
