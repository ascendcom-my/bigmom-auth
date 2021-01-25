# Bigmom Auth

An authentication and authorization package mainly for other bigmom packages. I guess you can use it in your app as well, but why would you?

## Installation

- `composer require bigmom/auth`
- `php artisan vendor:publish`
- `php artisan migrate`

## Usage

Make sure you set the superusers, driver, and provider in the config file published. Access the management UI through `/bigmom`.