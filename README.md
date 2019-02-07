# Skeleton Project
[![Build Status](https://travis-ci.org/rorteg/app_skeleton.svg?branch=master)](https://travis-ci.org/rorteg/app_skeleton)

## Requirements
* PHP ^7.1
* PHP PDO extension
* PHP json extension
* node/npm

------

## Installation

### 1 - Composer create project

```
composer create-project rorteg/app_skeleton -s dev -n
```

### 2 - Configure the access data for the database

Before setting up, create a new database.

```
vim phinx.yml
```

```
vim app/config/db.php
```

### 3 - Perform the database migration

```
vendor/bin/phinx migrate
```
```
vendor/bin/phinx seed:run
```

### 4 - NPM

```
npm install
```


### 5 - PHP Server

```
php -S localhost:8085 -t pub/
```

-------

## Usage

Go to http://localhost:8085 and click Admin menu.

| Username | Password|
|----------|---------|
|   admin  | admin@123 |
