# Catsgram
> A web application where detects whether an image uploaded by a user contains a picture of a cat. In an administrative back-end area, a website's basic structure (i.e., users, posts, themes) can be dynamically created and modified by only authorized users with the appropriate permissions. The front-end site will be viewable by all users including guests, but users can register and on subsequent visits log in in order to be able to contribute and make some changes to feed content.
> Live demo [_here_](https://catsgram.herokuapp.com). <!-- If you have the project hosted somewhere, include the link here. -->

## Table of Contents
* [General Info](#general-information)
* [Technologies Used](#technologies-used)
* [Features](#features)
* [Screenshots](#screenshots)
* [Setup](#setup)
* [Project Status](#project-status)
* [Room for Improvement](#room-for-improvement)
* [Contact](#contact)
<!-- * [License](#license) -->


## General Information
It was my final assignment for web application programming. I received a mark of 100%, with a final course mark of 98%.
I deployed this application using Heroku and AWS Relational Database Service. However, I could not use AWS RDS anymore because I was using a school account. So, I used ClearDB to build my app using native MySQL databases instead. In class, I used Laravel version 6 and PHP 7 but upgraded Laravel version to 8 and PHP version to 8.1 and added image uploading, comments functionalities, and a third party API to detect cat's images after the course ended.

## Technologies Used
- React - version 18.2.0
- TypeScript - version 5.0.4
- JavaScript
- Jest - version 29.5.0
- Webpack
- Laravel Mix
- NPM
- Laravel - version 8.0
- PHP - version 8.1
- MySQL
- ClearDB
- Heroku


## Features
- The application is able to detect whether an image uploaded by a user contains a picture of a cat.
- A users admin page that lists all users and provides buttons to perform required actions on users. (Show, Edit, Delete)
- A create user page that provides fields for creating a new user as well as a field to tie a user to one or more of the available roles.
- An edit page that allows modifications to an existing user
- The capability to delete a user via Soft Deleting
-	A themes admin page that lists all users and provides buttons to perform required actions on users. (Show, Edit, Delete)
-	A create theme page that provides fields for creating a new theme.
-	An edit page that allows modifications to an existing theme.
-	The capability to delete a theme via Soft Deleting
-	All applicable pages provide basic validation functionality to maintain valid data.
- A comments feature.

## Screenshots
![catsgram2](https://user-images.githubusercontent.com/71358207/236655000-34d72397-7966-45d0-9ba8-2d3f4b3401fd.gif)

## Setup
To run this project make a .env file in the root of this project and in the ternimal, type:
```
$ cd ../Catsgram
$ composer install
$ npm install
$ php artisan serve
```

## Project Status
Project is complete. I am no longer working on it.

## Room for Improvement
If you find a bug, kindly open an issue [here](https://github.com/DevTaehong/Catsgram/issues/new) by including your search query and the expected result.

If you'd like to request a new function, feel free to do so by opening an issue [here](https://github.com/DevTaehong/Catsgram/issues/new). Please include sample queries and their corresponding results.

## Contact
Created by [@taehong](https://linkedin.com/in/taehong) - feel free to contact me!

## License
This project is open source and available under the MIT © [Taehong Min ](https://github.com/DevTaehong/Catsgram/blob/master/License).

