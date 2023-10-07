## Blog

This is a simple blog application written in Symfony 6 and PHP.

There is no client-side Javascript.

This took around one day of development.

## Installation

$ composer install
$ npm install
$ npm run dev
$ docker-compose up

Then browse to http://localhost:8080

## Contributing Guide

The recommended way to install PHP CS Fixer is to use [Composer](https://getcomposer.org/download/)
in a dedicated `composer.json` file in your project, for example in the
`tools/php-cs-fixer` directory:

```console
mkdir -p tools/php-cs-fixer
composer require --working-dir=tools/php-cs-fixer friendsofphp/php-cs-fixer
```

Before commit, call `composer standardize` to apply code styling

