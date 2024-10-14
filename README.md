# TODO App

A simple TODO application built with PHP and PostgreSQL that allows users to manage their tasks.

## Table of Contents

- [Features](#features)
- [Usage](#usage)

## Features

### Prerequisites

- PHP 7.4 or higher
- PostgreSQL

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/adnjoo/zxc.git
   cd todoapp
   ```

2. Create the PostgreSQL database:

   ```sql
   CREATE DATABASE todoapp;
   ```

3. Run the migration to set up the database schema:

   ```bash
   php src/migration/migrate.php
   ```

## Usage

### Start the PHP Server

To run the application, start the built-in PHP server and navigate to http://localhost:8080:

```bash
php -S localhost:8080 -t public
```
