# MiniGreX CMS (Delta)

⚠️ still developing, it will not work yet! Want to help me? smallest high secure multi-cms for DevOps & Hidden World 👮
![MiniGreX Logo](documentation/header_minigrex.png)

## Table of Contents
- [Security](#security)
- [Introduction](#introduction)
- [Installation](#installation)
- [Features](#features)
- [Admin Panel](#the-admin-panel)
- [User Panel](#the-user-panel)
- [Usage](#usage)
- [Credits](#credits)
- [Contributing](#contributing)
- [License](#license)

## Security
MiniGreX-CMS will be designed with security in mind, and the code will be written to minimize the risk of SQL injection attacks and other security vulnerabilities. To ensure maximum security, we recommend keeping the CMS up-to-date with the latest security patches and using strong passwords for all user accounts.

## Introduction
MiniGreX CMS is a lightweight and secure content management system that allows users to share links, images, videos, and comments. The system is designed to be easy to use and to work on different database systems like MySQL, MariaDB, and Postgres.

This CMS is built with PHP PDO and uses prepared statements to prevent SQL injection attacks. The code will be optimized for performance, making it a fast and efficient way to manage content.

[Documentation for this project](documentation/)

## Installation
To install MiniGreX CMS, follow these steps:

1. Install a web server with Apache or Nginx. (Secure your server!)
2. Install PHP 7.4 or higher.
3. Install the latest MySQL, PostgreSQL, or MariaDB.
4. Download or clone the latest stable repository from GitHub.
5. Create a database for MiniGreX CMS in MySQL, MariaDB, or Postgres.
6. Import the SQL file sgl.txt into your database.
7. Update the init.php file with your database credentials.
8. Upload the files to your server.
9. Change file and folder permissions.
10. Navigate to the index.php file to view the CMS.

## Features -> still in progress
- User authentication (ready)
- Admin panel for managing the site information and user accounts (ready)
- Ability to share links, images, and videos (only post, links ready)
- Comment system (ready)
- Prepared statements to prevent SQL injection attacks (check)
- Supports MySQL, MariaDB, and Postgres (check)
- Fore SSL (check)
- Admin Panel (Bootstrap starter?)
- Lazyload + Image Customizer
- Image & Video Database
- SEO Tools
- Gateway Tools
- Role Manager
- Deep Web mode (for DevOps+)


## The admin (panel)
allows the admin to manage the site information and user accounts e.g. It includes the following features:

- Change the site title and description (ready)
- Change the admin/User password (ready)
- View a list of all users and delete user accounts (Pagination needed)


## The user (panel )
- Change the User password 
- create post, links, coments, upload images, videos

## Public files> functions
- login.php + stmt (ready)
- register.php + stmt (ready)

## Usage
Once you have installed MiniGreX-CMS, you can start using it to share links, images, and videos. The main page shows all the posts that have been shared, along with any comments that have been added. To add a new post, simply click on the "Add Post" button and fill in the form.

To add a comment to a post, you need to be logged in. Click on the "Log in" link at the top of the page to log in, or click on the "Register" link to create a new user account.

As an admin, you can also access the admin panel by clicking on the "Admin" link at the top of the page. From here, you can change the site title and description, as well as change the admin password.

## Copyright
MiniGreX CMS was created by Volkan Kücükbudak , still yet ;)
- [VolkanSah on Github](https://github.com/volkansah)
- [Developer Site](https://volkansah.github.io)
- [Become a 'Sponsor'](https://github.com/sponsors/volkansah)

## Contributing
If you want to contribute to this CMS, please create a new branch and submit a pull request. We welcome all contributions, including bug fixes, feature requests, and translations.

### Thank you for your support!
- If you appreciate my work, please consider [becoming a 'Sponsor'](https://github.com/sponsors/volkansah), giving a :star: to my projects, or following me. 
### Credits
- [VolkanSah on Github](https://github.com/volkansah)
- [Developer Site](https://volkansah.github.io)

### License
MiniGreX CMS is licensed under the MIT [LICENSE](LICENSE) . Feel free to use it for personal or commercial use.

### Dev
### Structur

```
MiniGreX-CMS-main/
├── cache/
│   └── README.md
├── documentation/
│   ├── README.md
│   └── de/
│       ├── README.md
│       ├── admin-security.md
│       ├── core-security.md
│       ├── core_functions.md
│       ├── plugin_image_db.md
│       ├── plugin_seo_manager.md
│       ├── public-security.md
│       ├── security_upload_function.md
│       └── social-integration.md
├── includes/
│   └── README.md
├── panel/
│   └── README.md
├── plugins/
│   ├── README.md
│   ├── gateway_manager/
│   │   └── README.md
│   ├── get_local_settings/
│   │   └── README.md
│   ├── image_db/
│   │   └── README.md
│   ├── profile_manager/
│   │   └── README.md
│   ├── rolle_manager/
│   │   └── README.md
│   ├── seo_manager/
│   │   └── README.md
│   └── video_db/
│       └── README.md
├── themes/
│   └── README.md
└── README.md
```


