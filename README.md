#Dropbox api

*Dropbox v2 API for laravel*

### Third party packages:
* *guzzle: Handle XHR requests*

###Installation
* Add This lines in your ```composer.json```

    ``` "jeylabs/dropbox": "dev-master" ```
    ```
    "repositories": [
           {
             "type": "vcs",
             "url": "https://github.com/jeylabs/dropbox"
           }
         ],
     ```

* Publish the config file. <br>

    ```php artisan vendor:publish --provider="Jeylabs\DropBox\DropBoxServiceProvider"```

###Config
```php
return [
    'access_token' => env("DROPBOX_ACCESS_TOKEN"),
];
```

###Powered by - Ceymplon
