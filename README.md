> Please do not use this repository for writing any sort of functionality! Once
> you are ready to try to get your own app up and running, choose from
> the many popular frameworks already offered by the PHP community: Laravel, Symfony, etc.

# serverless-mvc-app
This repository is meant for use by viewers of our serverless PHP deployments using AWS Lambda
course. However, if there is anything you feel you can make use of in this repository please
don't hesitate to do so!

We built this repo to help you learn about serverless regardless of your framework of choice, but
please ensure you use a proper framework when you start putting pen to paper.

## How to run
We recommend using PHP's built-in web server to start the app. Make sure you
specify that the webroot must be `public`:
```bash
php -S localhost:8080 -t public
```

## Requirements
- [PHP 8.1](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/) _(Just necessary for the AWS SDK and Predis)_

## Credentials
You can provide database, Redis, and AWS credentials in the following ways:
- Environment variables
- A `secrets.php` file in the root of the repository, it is similar to a `.env` file
  - The `secrets.example.php` file is a good template for starters

You can take a look at the `functions.php` file to see what environment variables are available.

**This data will be fed in by Lambda, so there is no need to add it to your app bundle.**

## Notes and Docs
We believe that the best way to learn is by doing. You can feel free continue to use
this sample project to test out concepts you think may work differently in a 
serverless environment.

**Important files:**
- **`public/index.php`** - Entrypoint for the app, routes are registered here.
- **`functions.php`** - `config` and `view` helpers

**Other important things:**
- Predis is used to persist and centralize session data
- Temporary files must be truly temporary for a single request

