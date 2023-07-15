# Hospital Management System

## Description
The Hospital Management System is a web application designed to streamline the management of patients, doctors, consultations, and schedules in a hospital setting. It provides features such as patient registration, doctor assignment, appointment scheduling, and note management.

## Features
- User authentication and role-based access control
- Patient registration and management
- Doctor assignment and consultation management
- Batch and timetable management for nurses
- Note management for medical progress tracking
- Printable medical progress report

## Prerequisites
- PHP 7.4 or higher
- Laravel Framework 8.x
- MySQL 5.7 or higher

## Installation
1. Clone the repository: `git clone https://github.com/your-username/hospital-management-system.git`
2. Navigate to the project directory: `cd hospital-management-system`
3. Install the dependencies: `composer install`
4. Rename the `.env.example` file to `.env`: `mv .env.example .env`
5. Generate the application key: `php artisan key:generate`
6. Configure the database connection in the `.env` file:
   - Set the `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` variables according to your database setup.
7. Run the database migrations: `php artisan migrate`
8. Start the development server: `php artisan serve`

## Usage
1. Access the application in your web browser at `http://localhost:8000`
2. Register as a new user or log in with existing credentials
3. Use the different features of the system to manage patients, doctors, consultations, batches, timetables, and notes


## API Documentation
- The Hospital Management System does not expose an API.

## Technologies Used
- PHP
- Laravel Framework
- MySQL
- HTML
- CSS
- JavaScript

## Development
- The project was developed using Laravel, following the MVC architectural pattern.
- The database models, controllers, and views are organized in their respective directories.
- Blade templating engine is used for rendering views.
- Form validation and request handling are implemented using Laravel's built-in validation and form request classes.

## Contributing
- Contributions are welcome! Fork the repository and create a new branch for your feature or bug fix. Submit a pull request when ready.

## Issues
- If you encounter any issues or bugs, please report them in the issue tracker on GitHub.

## License
This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).

## Acknowledgements
- The project was developed for final year project.

## Contact
For any inquiries or further information, please contact me at ishimweyvan90@gmail.com.
