
# Laravel Restaurant Website

## Overview
This project is a **Restaurant Management System** built using Laravel. It provides functionality for administrators to manage restaurant operations efficiently, including categories, menus, contact information, and orders. For users, the website serves as an online platform to explore the restaurant menu and place food orders, making it easy to enjoy the restaurant's offerings from anywhere.

---

## Features
- **Category Management**: Admins can create, update, and delete categories for organizing the menu.
- **Menu Management**: Add, edit, and delete menu items with details like pricing, description, and categories.
- **Contact Management**: Manage the restaurant's contact information, including phone numbers, addresses, working hours, and social media handles.
- **Order Management**: View and process customer orders efficiently.
- **Explore Menu**: Customers can browse the restaurant's menu, filter by categories, and view detailed information about each item.
- **Online Food Ordering**: Users can add menu items to their cart, place orders online, and receive confirmation for their orders.
- **Responsive Design**: The website is fully responsive, ensuring it works seamlessly on all devices.
- **Dynamic Content**: Admins can update information like working hours, addresses, and phone numbers dynamically.

---

## Tools & Technologies Used
- **Laravel Framework**: PHP framework for building robust web applications.
- **MySQL**: Database for storing restaurant data (menus, orders, contact info, etc.).
- **AdminLTE 3**: For the admin dashboard interface ([AdminLTE 3 Dashboard](https://adminlte.io/themes/v3/)).
- **HTML5 & CSS3**: For building the front-end structure and design.
- **JavaScript & jQuery**: For interactive elements and dynamic behavior.
- **Bootstrap**: For responsive design and layout.
- **Templatemagic**: Portfolio template ([Portfolio by Templatemagic](https://themeforest.net/user/templatemagic/portfolio)).

---

## How to Run This Project on Your Local Machine
Follow these steps to set up and run the project locally:

### **Step 1: Clone the Repository**
```bash
git clone https://github.com/chrysanthusobinna/restaurant.git
cd restaurant
```

### **Step 2: Install Dependencies**
Install the necessary PHP and JavaScript dependencies:
```bash
composer install
npm install
```

### **Step 3: Set Up the Environment**
1. Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```
2. Generate the application key:
   ```bash
   php artisan key:generate
   ```
3. Configure your `.env` file with the correct database credentials and other settings.

### **Step 4: Set Up the Database**
1. Create a new MySQL database (e.g., `restaurant_db`).
2. Run migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```

### **Step 5: Build Front-End Assets**
Compile the front-end assets using Laravel Mix:
```bash
npm run dev
```
For production builds:
```bash
npm run prod
```

### **Step 6: Start the Application**
Run the development server:
```bash
php artisan serve
```
Visit the application at `http://127.0.0.1:8000`.

---

## Credits
- **[AdminLTE 3](https://adminlte.io/themes/v3/)**: The admin dashboard design is powered by AdminLTE 3, offering a modern and customizable interface.
- **[Templatemagic Portfolio](https://themeforest.net/user/templatemagic/portfolio)**: The front-end template for the website is inspired by Templatemagic's portfolio designs.

---

Feel free to fork this repository or contribute to its development by submitting a pull request! 
 
