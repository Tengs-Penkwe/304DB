# CPSC 304:  Database Project

This repository hosts the work for a team project in CPSC 304: Introduction to Relational Databases, a course at the University of British Columbia. The aim is to design and implement a relational database system from scratch for managing public transportation routes.

## Table of Contents
- [General Info](#general-info)
- [Getting Started](#getting-started)
- [Team](#collaboration)

## General Info

The goal of this project is to understand the end-to-end process of designing and implementing a relational database system. The application for which the database is designed is a

Certainly! Here's a step-by-step guide to opening and running the project:

## Getting Started

Follow these steps to get the project up and running on your local machine:

### Prerequisites

- Ensure that you have a web server with PHP support (such as Apache) installed on your machine.
- Make sure PHP 7.x or later is installed.
- A web browser is needed to view the application.

### Installation

1. **Clone the Repository**: Clone the repository to your web server's root directory using the command:
   ```
   git clone https://github.com/your_repository_url.git
   ```

2. **Configure Database Permissions**: Ensure the permissions on the SQLite database file (`LOL.db`) are set correctly. The web server must have read and write access.

3. **Configure Web Server**: Configure your web server to serve the project's root directory. If using Apache, you might need to update the `httpd.conf` file or create a virtual host configuration.

4. **Start PHP Server (If Using Built-in Server)**: If you're using PHP's built-in server, navigate to the project directory in the terminal and run:
```
php -S localhost:8000
```

### Usage

1. **Navigate to Project URL**: Open a web browser and navigate to the URL where your server is hosting the project. If using PHP's built-in server, the URL might look like:
http://localhost:8000

2. **Explore the Platform**: Use the navigation links to explore different sections of the League of Legends Game Platform, such as Profiles, Champions, and Store.

3. **View Summoners**: On the main page, you will find a list of Summoners with details like ID, Level, Rank, and Money.

### Troubleshooting

If you encounter any issues, make sure:

- The web server is running and configured correctly.
- The database file (`LOL.db`) has the correct permissions.
- The project's directory path in the URL is correct.

For additional support, please refer to the project's documentation or raise an issue on the GitHub repository.


## Timeline & Task breakdown

[Task](TimeLine.md)

## Collaboration

This project is a collaborative effort by:

- [Tengs](https://github.com/Tengs-Penkwe)
- [Chenguang](https://github.com/)
- [Oblivious](https://github.com/)

