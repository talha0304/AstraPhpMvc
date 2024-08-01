Certainly! Here is the updated documentation for the Astraphpmvc framework, including features for updating and deleting users:

---

**Welcome to the Astraphpmvc Framework!**

This project is designed for educational purposes to demonstrate a basic PHP MVC framework. It currently supports session management, flash messages, routing, user login/logout, user addition, display, update, and delete operations.

### Features
- Session Management
- Migrations
- Flash Messages
- Master Layout
- Routing
- Form Validation
- User Validation
- Database Validation
- User Login/Logout
- Add User
- Show User
- Update User
- Delete User
- Protected Routes

### Installation
Follow these steps to get started with the Astraphpmvc framework:

#### 1. Install the Framework
Use Composer to install the framework:
```bash
composer require astraphp/phpmvc
```

#### 2. Navigate to the Project Directory
Change to the project directory:
```bash
cd vendor/astraphp/aphpmvc/public
```
This is the entry point of the project.

#### 3. Configure Your Database
Update the `.env` file with your database connection details.

#### 4. Start the Server
Start the PHP built-in server with the following command:
```bash
php -S localhost:8080
```

#### 5. Run Migrations
Navigate to the `phpmvc` directory and run the migrations:
```bash
cd path/to/phpmvc
php migration.php
```

### Contributing
We welcome contributions to the Astraphpmvc framework! If you would like to contribute, please fork the repository and submit a pull request. Ensure your contributions follow the existing coding standards and include appropriate tests.

Note: This project is intended for educational purposes only. While contributions are encouraged, the framework is not fully tested for production environments. Use it at your own risk if deploying in production settings.

### License
This project is licensed under the terms specified by Talha Saleem. You may use and contribute to this project, but it cannot be sold or used for commercial purposes.

Happy coding!
