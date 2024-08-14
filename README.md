# Guest List Application

## Overview

This project is a simple web application that includes:
- **`guestlist.php`**: A PHP script to display a list of guests from a DynamoDB table.
- **`login.php`**: A PHP script for user authentication.
- **`index.html`**: A basic HTML file for the homepage.
- **Docker**: Configuration to build and run a Docker container for the application.

## Project Structure

/your-project
│
├── guestlist.php
├── login.php
├── index.html
├── Dockerfile


### `guestlist.php`

This PHP script fetches a list of guests from an AWS DynamoDB table named `GuestBook` and displays it in an HTML table. It requires the user to be logged in to access the guest list.

### `login.php`

A simple PHP script that handles user authentication. Users must log in to access protected resources like the guest list.

### `index.html`

A basic HTML file that serves as the homepage for the application. Customize it to fit the needs of your project.

## Docker Configuration

### `Dockerfile`

The `Dockerfile` is used to build a Docker image for this application. It includes instructions to set up the PHP environment and copy the application files into the image.

```Dockerfile
# Use an official PHP runtime as a parent image
FROM php:7.4-apache


# Copy the local source code to the Docker image
COPY . /var/www/html/

# Expose port 80 to the outside world
EXPOSE 80




