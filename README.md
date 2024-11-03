# info-bridge-pro
Info Bridge Pro is a web-based company management system built using PHP, MySQL, and Docker. The application allows users to view and manage company-related information, including employees, departments, projects, and more. The project is designed to run within Docker containers to streamline deployment and setup.

## Project Features
Employee Directory: View detailed information about employees, including their SSN, name, address, department, and salary.
Department Overview: Access details of departments, managers, and associated projects.
Employee Salaries by Department: List of employees with salary information categorized by department.
Browse Departments: Navigate through various departments and see assigned projects.

## File Structure
```bash
docker-workspace/
├── db_data/                 # MySQL data storage
├── src/                     # Source files for the PHP application
│   ├── companyBrowse.php    # Browse Departments view
│   ├── DbConnect.php        # Database connection file
│   ├── departmentDetails.php# Detailed view for departments
│   ├── deptView.php         # Main department overview page
│   ├── empdept.php          # Employee salaries by department view
│   ├── empView.php          # Employee detailed view
│   ├── index.php            # Main application entry point
│   ├── p1.php               # Page with dropdown for selecting employee SSN
│   ├── p1post.php           # Processing page for employee details
│   ├── projView.php         # Project view details
├── docker-compose.yml       # Docker Compose file to set up services
├── Dockerfile               # Dockerfile for PHP and Apache setup
└── README.md                # Project documentation
```
## Prerequisites
Docker: Ensure Docker is installed on your system.
Docker Compose: Make sure Docker Compose is available for managing multi-container Docker applications.
## Setup Instructions

1. **Clone the repository**:
    ```bash
    git clone <repository-url>
    cd project-directory
    ```

2. **Build and Start the Docker Containers**:
    ```bash
    docker-compose up --build
    ```

3. **Access the Application**:
   Once Docker is running, access the app at `http://localhost:80` in your web browser.

4. **Database Initialization**:
   The `company` database and tables will be created automatically on startup.

## Data Loading Instructions

To load data from `.dat` files, follow these steps:

1. Place your data files in the `data` folder.
2. Use the MySQL command line within the Docker container:
   ```bash
   docker exec -it <mysql-container-name> mysql -u root -p company < /data/filename.dat


# Info Bridge Pro - Employee Management System

**Info Bridge Pro** is an employee management web application built using PHP, MySQL, and Docker, designed to efficiently manage departments, employees, dependents, projects, and project assignments within an organization.

## Project Overview

This project is structured in a Docker environment, with a MySQL database backend and PHP for the server-side scripting. The main features include:
- **Employee Directory**: List all employees with details.
- **Department Overview**: View department-specific information.
- **Employee Salaries by Department**: Visualize employee salaries organized by department.
- **Browse Departments**: Navigate through different departments.

## File Structure

- `src/`: Contains all PHP files for different functionalities of the system.
  - `index.php`: Main entry point of the application.
  - `DbConnect.php`: Database connection setup.
  - Additional pages like `empdir.php`, `deptoverview.php`, `empsalary.php` handle respective functionalities.
- `docker-compose.yml`: Configures Docker services.
- `Dockerfile`: Configures the PHP server with necessary extensions.

## Requirements

- Docker
- Docker Compose
- MySQL 8.0+

## Setup Instructions

1. **Clone the repository**:
    ```bash
    git clone <repository-url>
    cd project-directory
    ```

2. **Build and Start the Docker Containers**:
    ```bash
    docker-compose up --build
    ```

3. **Access the Application**:
   Once Docker is running, access the app at `http://localhost:80` in your web browser.

4. **Database Initialization**:
   The `company` database and tables will be created automatically on startup.

## Data Loading Instructions

To load data from `.dat` files, follow these steps:

1. Place your data files in the `data` folder.
2. Use the MySQL command line within the Docker container:
   ```bash
   docker exec -it <mysql-container-name> mysql -u root -p company < /data/filename.dat
Replace <mysql-container-name> with your container's name and filename.dat with your data file.

## Technologies Used
PHP: Server-side language for dynamic page rendering.
MySQL: Database for storing organizational data.
Docker: Containerization tool to deploy the app consistently.
Bootstrap: Frontend framework for responsive design.

## Demo Link
https://www.youtube.com/watch?v=0k1FNOR7WXk&nbsp;

## Additional Resources
Docker Documentation: https://docs.docker.com/
