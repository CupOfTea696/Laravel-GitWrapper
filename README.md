# Laravel GitWrapper

Laravel GitWrapper is a [GitWrapper](https://github.com/cpliakas/git-wrapper) bridge for Laravel 5.

## Installation

Laravel GitWrapper requires PHP 7.1 or up. It supports Laravel 5.5 - 5.7 only.

To get the latest version, simply require the project using [Composer](https://getcomposer.org/).

```bash
$ composer require cupoftea/laravel-git-wrapper
```

If you are not using automatic package discovery, you'll need to register the `CupOfTea\GitWrapper\GitWrapperServiceProvider` service provider in your `config/app.php`.

You can also optionally alias the facade by adding the following line to your `aliases` in `config/app.php`.

```php
        'Git' => CupOfTea\GitWrapper\Facades\Git::class,
```

## Configuration

The Laravel GitWrapper requires connection configuration.

To get started, publish the vendor assets.

```bash
$ php artisan vendor:publish
```

This will create a `config/git.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

There are three configuration options:

##### Logger

This option (`'logger'`) is where you can enable logging, and set which log channel or log channel stack to use. To enable logging using the default channel, simply set this option to `true`. If you want to log to a specific channel, provide the channel name. Lastly, if you want to log to a channel stack, provide an array of log channels to use.

##### Default Connection Name

This option (`'default'`) is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `'main'`.

##### Git Connections

This option (`'connections'`) is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like. Note that the 2 supported authentication methods are: `"ssh_key"`, and `"none"`. When using the `"ssh_key"` method, you are required to provide the `"key_path"` option as well, which is the path to your private SSH key.
