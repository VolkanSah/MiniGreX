# MiniGreX CMS
## Introduction
MiniGreX CMS is a lightweight and secure content management system that allows users to share links, images, videos, and comments. The system is designed to be easy to use and to work on different database systems like MySQL, MariaDB, and Postgres.

This CMS is built with PHP and uses prepared statements to prevent SQL injection attacks. The code has been optimized for performance, making it a fast and efficient way to manage content.

## Installation
To install MiniGreX CMS, follow these steps:

Download or clone the repository from Github.
Create a database for MiniGreX CMS in MySQL, MariaDB, or Postgres.
Import the SQL file minigrex_cms.sql into your database.
Update the config.php file with your database credentials.
Upload the files to your server.
Navigate to the index.php file to view the CMS.

## Features
- User authentication
- Admin panel for managing the site information and user accounts
- Ability to share links, images, and videos
- Comment system
- Prepared statements to prevent SQL injection attacks
- Supports MySQL, MariaDB, and Postgres
- Admin Panel
- The admin panel allows the admin to manage the site information and user accounts. It includes the following features:

- Change the site title and description
- Change the admin password
- View a list of all users and delete user accounts
## Credits
MiniGreX CMS was created by Volkan `sah` Kücükbudak

## License
MiniGreX CMS is licensed under the MIT License. Feel free to use it for personal or commercial use.

We hope this helps! If you have any questions or need further assistance, feel free to ask.



# MiniGreX-CMS
MiniGreX-CMS is a simple CMS for sharing links, images, and videos. The CMS has a comment function, and users can add and delete comments, as well as upload and share images, links, and videos from other portals. The CMS has been designed with security in mind and aims to be a safe and fast solution for sharing content.

# Installation
To install MiniGreX-CMS, you need to have a web server with PHP and a MySQL or PostgreSQL database. Follow these steps to get started:

Clone the repository to your server's web root directory.
Create a new database and import the minigrex_cms.sql file to create the necessary tables.
Create a new user with administrative privileges by running the following SQL command:
sql
Copy code
INSERT INTO admins (username, password) VALUES ('admin', '$2y$10$1j/19J/wbHwI01Z.VzdMseLgYnU6FvU6EudU6ivIlU6JfaG2Bz0NO');
The password for the new admin user is password. You should change this password immediately after logging in to the CMS.

Edit the config.php file and replace the database connection settings with your own.
Usage
Once you have installed MiniGreX-CMS, you can start using it to share links, images, and videos. The main page shows all the posts that have been shared, along with any comments that have been added. To add a new post, simply click on the "Add Post" button and fill in the form.

To add a comment to a post, you need to be logged in. Click on the "Log in" link at the top of the page to log in, or click on the "Register" link to create a new user account.

As an admin, you can also access the admin panel by clicking on the "Admin" link at the top of the page. From here, you can change the site title and description, as well as change the admin password.

Security
MiniGreX-CMS has been designed with security in mind, and the code has been written to minimize the risk of SQL injection attacks and other security vulnerabilities. To ensure maximum security, we recommend keeping the CMS up-to-date with the latest security patches and using strong passwords for all user accounts.

License
MiniGreX-CMS is licensed under the MIT license. See the LICENSE file for more information.

If you have any questions or feedback, please feel free to get in touch. We hope you find MiniGreX-CMS useful and easy to use!
