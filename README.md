# Setting the Scrip autoload for src

- Add below lines to `composer.json` below "require".

```
"autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
```

- Then run the following command

```
composer dump-autoload
```
