## About

This project was built on top of [Laravel](https://laravel.com) 8, [Vuejs](https://vuejs.org/) and [Vuex](https://vuex.vuejs.org/guide/) with [Material UI](https://vuematerial.io/)

## Requirements

* PHP >= 7.3
* MySQL
* NodeJS with Yarn package manager


## Features

- [x] People could login/logout to the system
- [x] Dashboard page with a header, sidebar and main content panel
- [x] Admin could create and assign tasks to users and himself
- [x] Every one can do complete assigned tasks

## Setup

#### Laravel

```
$ composer install
$ php artisan migrate:fresh --seed
```

#### Vue

```
$ yarn install 
$ yarn run prod
```

## Test credentials

Admin: `admin@admin.com` / `admin`

User: `john@user.com` / `default` 

