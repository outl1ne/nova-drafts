# Nova Drafts

<!---[![Latest Version on Packagist](https://img.shields.io/packagist/v/optimistdigital/nova-drafts.svg?style=flat-square)](https://packagist.org/packages/optimistdigital/nova-drafts)
[![Total Downloads](https://img.shields.io/packagist/dt/optimistdigital/nova-drafts.svg?style=flat-square)](https://packagist.org/packages/optimistdigital/nova-drafts)--->

This [Laravel Nova](https://nova.laravel.com) field allows you to make drafts of your resources.

## Features

- **Create Drafts**
- **Artisan Command to create Migration**

## Screenshots

![Detail View](./docs/nova-drafts-details-view.png)

![Form View](./docs/nova-drafts-form-view.png)

![Index View](./docs/nova-drafts-index-view.png)

## Installation

Install the package in a Laravel Nova project via Composer:
```bash
composer require optimistdigital/nova-drafts
```

## Usage

### Preparing the models and database

This field requires a few database changes - namely, the model requires three new columns  
**Migrations can be created using the following Artisan command:**  
```bash
php artisan drafts:migration {table?}
```
if table name is not provided, a choice of all available tables is provided.



