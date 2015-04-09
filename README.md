# Laravel Settings

Web-Application settings for Laravel. An easy way to use yet powerful way to store and retrieve settings in your database. 
Use Settings for storing things like website title or general variables that are used throughout your development, and want to make the modification of these values easy.

Couple it together with a backend page to add/modify/delete settings on the fly, and you have yourself the perfect settings page.

### Installation

In your Laravel project's composer.json file, add `settings` as a dependency in the require object:

```js
"mschinis/settings": "dev-master"
```

Use `composer update` for composer to update the dependencies and download the package.

Once installed, add the ServiceProvider to your provider array and the Setting alias to your aliases array within `app/config/app.php`:

```php
'providers' => array(

    'Mschinis\Settings\SettingsServiceProvider'

)

'aliases' => array(

    'Setting' => 'Mschinis\Settings\Facades\Setting'

)
```

Setting up the database table is as easy as 1-2-3.

1. Publish the migration file to your migrations using `php artisan migrate:publish mschinis/settings`
2. Run the migration using `php artisan migrate`

Wait, no 3rd step? Yup. Tha-Tha-Tha-That's all folks! Enjoy using the settings package :)

### Usage
The package only stores the settings at the database, but more setting stores like redis/json file will be added soon.
The default table is `settings`. If you wish to modify the table name, you can do so by publishing the configuration file using `php artisan config:publish mschinis/settings` and changing the table in the published config file.

You can either access the setting store via its facade. A simple usage example is shown below.

```php
<?php
  Setting::set('app.title', 'My awesome website'); // Set a new setting / Update an existing setting
  $title_setting = Setting::get('app.title', 'default value'); // Retrieve the value of a setting, with a default fallback
  $title_setting = Setting::get('app.title'); // Retrieve the value of a setting with no default fallback
  $title_object = Setting::getObject('app.title') // Retrieve the Eloquent object model of the 'app.title' setting.
  Setting::forget('app.title'); // Remove a setting from the database
  $settings = Setting::all(); // Retrieve all settings from the database
?>
```

If the package fails to find a specific setting, and a default value is not provided, an exception will be thrown. To handle the exception you can use

```php
<?php

try{
  $title_setting = Setting::get('app.title');
}catch(Exception $e){
  // Handle error here.
}

?>
```

## Future work
1. Multilingual support for various extra fields, such as description
2. 
## Contact

Open an issue on GitHub if you have any problems or suggestions.

## License

The contents of this repository is released under the [MIT license](http://opensource.org/licenses/MIT).
