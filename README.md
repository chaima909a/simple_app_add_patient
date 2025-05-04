🩺 Patient Management App (PHP)
This project provides a simple web application to manage patient data. It allows adding, viewing, and managing patient records, including name, age, and email. The application is built using PHP, MySQL, and Docker, providing a lightweight and scalable solution for managing patient information.

Features:
Add Patient: Add new patient records with name, age, and email.

View Patients: Display a list of all patients added to the system.

Database Integration: Uses MySQL for storing patient data, with persistence for data.

Dockerized: The app is fully containerized using Docker, making it easy to deploy on any system with Docker support.

Technologies Used:
PHP 8.0 - Backend for handling requests and connecting to MySQL.

MySQL 5.7 - Database for storing patient data.

phpMyAdmin - A web-based interface for managing MySQL databases.

Docker - Containerizes the entire application, including the web server, database, and phpMyAdmin.

Getting Started
Prerequisites:
Docker & Docker Compose installed on your machine.

🚀 Steps to Run:
Clone this repository:
git clone https://github.com/chaima909a/simple_app_add_patient.git
cd nom-du-repo
Build and run the Docker containers using Docker Compose:
docker-compose up --build
Access the application:

App: http://localhost:8080

phpMyAdmin: http://localhost:8081

Username: root
Password: root

📦 File Structure:

├── Dockerfile              # Defines the PHP web server container

├── docker-compose.yml      # Configuration for services (web, db, phpMyAdmin)

├── index.php               # Main application to add/view patients



